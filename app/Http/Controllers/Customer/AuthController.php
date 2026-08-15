<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Customer;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('customer.dashboard');
        }

        // Save referrer as intended redirect url if it comes from our site and is not a login/register page
        $previousUrl = url()->previous();
        if ($previousUrl && $previousUrl !== route('customer.login') && $previousUrl !== route('customer.register') && !str_contains($previousUrl, 'logout')) {
            session(['url.intended' => $previousUrl]);
        }

        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is currently inactive/blocked. Please contact support.',
                ]);
            }

            // Ensure they have a customer record
            if (!$user->is_admin && !$user->customer) {
                $names = explode(' ', $user->name, 2);
                Customer::create([
                    'user_id' => $user->id,
                    'first_name' => $names[0] ?? 'User',
                    'last_name' => $names[1] ?? 'Customer',
                    'email' => $user->email,
                    'wallet_balance' => 0.00,
                    'reward_points' => 0,
                    'status' => 'active',
                ]);
            }

            $request->session()->regenerate();
            
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            if ($user->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');
        }

        // Save referrer as intended redirect url if it comes from our site and is not a login/register page
        $previousUrl = url()->previous();
        if ($previousUrl && $previousUrl !== route('customer.login') && $previousUrl !== route('customer.register') && !str_contains($previousUrl, 'logout')) {
            session(['url.intended' => $previousUrl]);
        }

        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => false,
                'status' => 'active',
            ]);

            Customer::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'wallet_balance' => 0.00,
                'reward_points' => 0,
                'status' => 'active',
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->intended(route('customer.dashboard'))->with('success', 'Welcome to RANISAHAB! Your account has been successfully created.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login')->with('success', 'Logged out successfully.');
    }

    // -----------------------------------------------------------------------
    // Google OAuth
    // -----------------------------------------------------------------------

    public function redirectToGoogle()
    {
        // Save referrer as intended redirect url if it comes from our site and is not a login/register/auth page
        $previousUrl = url()->previous();
        if ($previousUrl && $previousUrl !== route('customer.login') && $previousUrl !== route('customer.register') && !str_contains($previousUrl, 'auth/google')) {
            session(['url.intended' => $previousUrl]);
        }

        $clientId = \App\Models\Setting::getVal('google_client_id', env('GOOGLE_CLIENT_ID'));
        $clientSecret = \App\Models\Setting::getVal('google_client_secret', env('GOOGLE_CLIENT_SECRET'));
        $redirectUrl = \App\Models\Setting::getVal('google_redirect_uri', env('GOOGLE_REDIRECT_URI', route('customer.google.callback')));

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('customer.login')->withErrors([
                'email' => 'Google Login is not configured yet. Please enter Client ID and Client Secret in Admin Store Settings.',
            ]);
        }

        config([
            'services.google.client_id' => $clientId,
            'services.google.client_secret' => $clientSecret,
            'services.google.redirect' => $redirectUrl,
        ]);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $clientId = \App\Models\Setting::getVal('google_client_id', env('GOOGLE_CLIENT_ID'));
        $clientSecret = \App\Models\Setting::getVal('google_client_secret', env('GOOGLE_CLIENT_SECRET'));
        $redirectUrl = \App\Models\Setting::getVal('google_redirect_uri', env('GOOGLE_REDIRECT_URI', route('customer.google.callback')));

        config([
            'services.google.client_id' => $clientId,
            'services.google.client_secret' => $clientSecret,
            'services.google.redirect' => $redirectUrl,
        ]);

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('Google OAuth error: ' . $e->getMessage());
            return redirect()->route('customer.login')->withErrors([
                'email' => 'Google login failed. Please try again.',
            ]);
        }

        // Find by google_id first, then fall back to email
        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Link google_id if not already set
            if (!$user->google_id) {
                $user->update([
                    'google_id'     => $googleUser->getId(),
                    'google_avatar' => $googleUser->getAvatar(),
                ]);
            }

            // Block inactive accounts
            if ($user->status !== 'active') {
                return redirect()->route('customer.login')->withErrors([
                    'email' => 'Your account is currently inactive/blocked. Please contact support.',
                ]);
            }
        } else {
            // Create brand-new user + customer record
            $user = DB::transaction(function () use ($googleUser) {
                $nameParts = explode(' ', $googleUser->getName(), 2);

                $newUser = User::create([
                    'name'          => $googleUser->getName(),
                    'email'         => $googleUser->getEmail(),
                    'password'      => Hash::make(str()->random(32)),
                    'google_id'     => $googleUser->getId(),
                    'google_avatar' => $googleUser->getAvatar(),
                    'is_admin'      => false,
                    'status'        => 'active',
                ]);

                Customer::create([
                    'user_id'        => $newUser->id,
                    'first_name'     => $nameParts[0] ?? 'Google',
                    'last_name'      => $nameParts[1] ?? 'User',
                    'email'          => $googleUser->getEmail(),
                    'wallet_balance' => 0.00,
                    'reward_points'  => 0,
                    'status'         => 'active',
                ]);

                return $newUser;
            });
        }

        // Ensure customer record exists for older accounts
        if (!$user->is_admin && !$user->customer) {
            $names = explode(' ', $user->name, 2);
            Customer::create([
                'user_id'        => $user->id,
                'first_name'     => $names[0] ?? 'Google',
                'last_name'      => $names[1] ?? 'User',
                'email'          => $user->email,
                'wallet_balance'  => 0.00,
                'reward_points'   => 0,
                'status'          => 'active',
            ]);
        }

        Auth::login($user, true);

        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        $request->session()->regenerate();

        return redirect()->intended(route('customer.dashboard'));
    }

    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            return redirect()->route('customer.dashboard');
        }
        return view('customer.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }
        
        $token = \Illuminate\Support\Str::random(64);
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );
        
        $resetLink = route('customer.password.reset', ['token' => $token, 'email' => $request->email]);
        
        Log::info("Password Reset Link for {$request->email}: {$resetLink}");
        
        return back()->with('success', 'Password reset link generated successfully! Link: ' . $resetLink);
    }

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('customer.auth.reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        
        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'This password reset token is invalid or expired.']);
        }
        
        // Expiry check (60 minutes)
        if (now()->subMinutes(60)->gt($record->created_at)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'This password reset token has expired.']);
        }
        
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            
            return redirect()->route('customer.login')->with('success', 'Your password has been successfully reset! You can now log in.');
        }
        
        return back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }
}
