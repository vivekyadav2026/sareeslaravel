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
            'store_phone'         => 'nullable|string|max:50',
            'store_whatsapp'      => 'nullable|string|max:50',
            'store_email'         => 'nullable|email|max:100',
            'store_address'       => 'nullable|string|max:255',
            'makeup_studio_address' => 'nullable|string|max:500',
            'makeup_travel_availability' => 'nullable|string|max:1000',
            'makeup_serviceable_locations' => 'nullable|string|max:500',
            'business_hours'      => 'nullable|string|max:100',
            'instagram_url'       => 'nullable|url|max:255',
            'facebook_url'        => 'nullable|url|max:255',
            'youtube_url'         => 'nullable|url|max:255',
            'pinterest_url'       => 'nullable|url|max:255',
            'shiprocket_email'    => 'nullable|email',
            'shiprocket_password' => 'nullable|string|min:4',
            'shiprocket_pickup_location' => 'nullable|string',
            'google_client_id'    => 'nullable|string',
            'google_client_secret'=> 'nullable|string',
            'google_redirect_uri' => 'nullable|url',
            'google_maps_api_key' => 'nullable|string',
        ];

        $request->validate($rules);

        // Update settings in database
        Setting::setVal('shipping_rate_limit', $request->shipping_rate_limit);
        Setting::setVal('shipping_charge', $request->shipping_charge);
        Setting::setVal('gst_rate_default', $request->gst_rate_default);
        Setting::setVal('store_phone', $request->store_phone);
        Setting::setVal('store_whatsapp', $request->store_whatsapp);
        Setting::setVal('store_email', $request->store_email);
        Setting::setVal('store_address', $request->store_address);
        Setting::setVal('makeup_studio_address', $request->makeup_studio_address);
        Setting::setVal('makeup_travel_availability', $request->makeup_travel_availability);
        Setting::setVal('makeup_serviceable_locations', $request->makeup_serviceable_locations);
        Setting::setVal('business_hours', $request->business_hours);
        Setting::setVal('instagram_url', $request->instagram_url);
        Setting::setVal('facebook_url', $request->facebook_url);
        Setting::setVal('youtube_url', $request->youtube_url);
        Setting::setVal('pinterest_url', $request->pinterest_url);
        Setting::setVal('shiprocket_email', $request->shiprocket_email);
        Setting::setVal('shiprocket_password', $request->shiprocket_password);
        Setting::setVal('shiprocket_pickup_location', $request->shiprocket_pickup_location);
        Setting::setVal('google_client_id', $request->google_client_id);
        Setting::setVal('google_client_secret', $request->google_client_secret);
        Setting::setVal('google_redirect_uri', $request->google_redirect_uri);
        Setting::setVal('google_maps_api_key', $request->google_maps_api_key);

        // Log admin activity
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_settings',
            'details' => json_encode([
                'shipping_rate_limit' => $request->shipping_rate_limit,
                'shipping_charge' => $request->shipping_charge,
                'gst_rate_default' => $request->gst_rate_default,
                'shiprocket_email' => $request->shiprocket_email,
                'shiprocket_pickup_location' => $request->shiprocket_pickup_location,
                'google_client_id' => $request->google_client_id ? 'Configured' : null,
                'google_maps_api_key' => $request->google_maps_api_key ? 'Configured' : null,
            ]),
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('admin.settings.index')->with('success', 'Store configuration settings updated successfully.');
    }
}
