@extends('layouts.app')

@section('title', 'Create Account — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="auth-page-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="auth-card">
                    <h2 class="auth-card-title">Join Ranisahab</h2>
                    <p class="auth-card-subtitle">Create your account to unlock VIP features</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show bg-transparent border-danger text-danger mb-4" role="alert">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('customer.register.submit') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="auth-form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control auth-form-input" value="{{ old('first_name') }}" placeholder="Ananya" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="auth-form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control auth-form-input" value="{{ old('last_name') }}" placeholder="Sharma" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="auth-form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control auth-form-input" value="{{ old('email') }}" placeholder="ananya@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="auth-form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control auth-form-input" value="{{ old('phone') }}" placeholder="9876543210">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="password" class="auth-form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="form-control auth-form-input pe-5" placeholder="Min. 8 characters" required>
                                    <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password', this)" style="background: none; box-shadow: none;">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="auth-form-label">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control auth-form-input pe-5" placeholder="Repeat password" required>
                                    <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password_confirmation', this)" style="background: none; box-shadow: none;">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 form-check text-start">
                            <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                            <label class="form-check-label text-gold-light" for="terms" style="font-size: 0.7rem; letter-spacing: 0.05em; text-transform: uppercase;">I agree to the Terms of Service & Privacy Policy</label>
                        </div>

                        <button type="submit" class="btn-gold w-100 py-3 mb-4">
                            CREATE ACCOUNT <i class="fa-solid fa-user-plus ms-1"></i>
                        </button>
                    </form>

                    {{-- Google OAuth Divider --}}
                    <div class="d-flex align-items-center my-3">
                        <hr class="flex-grow-1 border-secondary border-opacity-25">
                        <span class="px-3 text-muted" style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase;">or sign up with</span>
                        <hr class="flex-grow-1 border-secondary border-opacity-25">
                    </div>

                    <a href="{{ route('customer.google.redirect') }}" id="btn-google-register"
                        class="d-flex align-items-center justify-content-center gap-2 w-100 py-3 mb-4 rounded-2"
                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); color: #e2d9c8; text-decoration: none; font-size: 0.82rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 600; transition: background 0.2s, border-color 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(203,166,110,0.5)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.15)'">
                        <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#EA4335" d="M24 9.5c3.2 0 5.9 1.1 8.1 2.9l6-6C34.5 3.1 29.6 1 24 1 14.9 1 7.1 6.6 3.6 14.5l7 5.4C12.4 13.7 17.7 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.5 2.8-2.2 5.2-4.7 6.8l7.3 5.7C43.6 37 46.5 31.2 46.5 24.5z"/>
                            <path fill="#FBBC05" d="M10.6 28.1A14.6 14.6 0 0 1 9.5 24c0-1.4.2-2.8.6-4.1l-7-5.4A23.9 23.9 0 0 0 0 24c0 3.9.9 7.5 2.6 10.8l7.3-5.7c-.2-.6-.3-1.3-.3-1z"/>
                            <path fill="#34A853" d="M24 47c5.6 0 10.3-1.8 13.7-5l-7.3-5.7c-1.9 1.3-4.3 2.1-6.4 2.1-6.3 0-11.6-4.2-13.5-9.9l-7.3 5.7C7.1 41.4 14.9 47 24 47z"/>
                        </svg>
                        Continue with Google
                    </a>

                    <div class="text-center pt-3 border-top border-secondary border-opacity-25 mt-2">
                        <p class="mb-0 small text-muted" style="font-size:0.75rem;">ALREADY HAVE AN ACCOUNT?</p>
                        <a href="{{ route('customer.login') }}" class="text-gold-light font-display fs-6" style="font-weight:600; letter-spacing:0.05em;">SIGN IN HERE <i class="fa-solid fa-arrow-right-long ms-1 fs-6"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(fieldId, button) {
        const field = document.getElementById(fieldId);
        const icon = button.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
