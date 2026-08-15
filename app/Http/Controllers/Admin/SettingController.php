<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\AdminActivityLog;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $rules = [
            'shipping_rate_limit' => 'required|numeric|min:0',
            'shipping_charge'     => 'required|numeric|min:0',
            'gst_rate_default'    => 'required|numeric|min:0|max:100',
            'shiprocket_email'    => 'nullable|email',
            'shiprocket_password' => 'nullable|string|min:4',
            'google_client_id'    => 'nullable|string',
            'google_client_secret'=> 'nullable|string',
            'google_redirect_uri' => 'nullable|url',
        ];

        $request->validate($rules);

        // Update settings in database
        Setting::setVal('shipping_rate_limit', $request->shipping_rate_limit);
        Setting::setVal('shipping_charge', $request->shipping_charge);
        Setting::setVal('gst_rate_default', $request->gst_rate_default);
        Setting::setVal('shiprocket_email', $request->shiprocket_email);
        Setting::setVal('shiprocket_password', $request->shiprocket_password);
        Setting::setVal('google_client_id', $request->google_client_id);
        Setting::setVal('google_client_secret', $request->google_client_secret);
        Setting::setVal('google_redirect_uri', $request->google_redirect_uri);

        // Log admin activity
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_settings',
            'details' => json_encode([
                'shipping_rate_limit' => $request->shipping_rate_limit,
                'shipping_charge' => $request->shipping_charge,
                'gst_rate_default' => $request->gst_rate_default,
                'shiprocket_email' => $request->shiprocket_email,
                'google_client_id' => $request->google_client_id ? 'Configured' : null,
            ]),
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Store configuration settings updated successfully.');
    }
}
