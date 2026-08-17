@extends('layouts.admin')

@section('title', 'Store Configuration Settings')

@section('content')
<div class="container-fluid py-3">

    <!-- Header & Breadcrumbs -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-gold mb-1"><i class="fas fa-gears me-2"></i>Store Settings</h3>
            <p class="text-muted small mb-0">Configure dynamic system variables including shipping thresholds, charges, and default tax parameters.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-dark text-success border-success mb-4" role="alert">
            <i class="fas fa-check-circle me-2 text-gold"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show bg-dark text-danger border-danger mb-4" role="alert">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-triangle me-2"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6 col-md-8 col-12">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <!-- Shipping & Tax Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom border-secondary d-flex align-items-center">
                        <h5 class="card-title text-gold mb-0"><i class="fas fa-calculator me-2"></i>Shipping &amp; Tax Coefficients</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Shipping Threshold Limit -->
                        <div class="mb-4">
                            <label for="shipping_rate_limit" class="form-label text-gold-light fw-bold">Free Shipping Threshold Limit (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0">₹</span>
                                <input type="number" step="0.01" name="shipping_rate_limit" id="shipping_rate_limit" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('shipping_rate_limit', \App\Models\Setting::getVal('shipping_rate_limit', '5000')) }}" 
                                    required min="0">
                            </div>
                            <small class="text-muted">Orders with a subtotal equal to or above this value will receive free shipping. (Current: ₹{{ number_format((float)\App\Models\Setting::getVal('shipping_rate_limit', '5000'), 2) }})</small>
                        </div>

                        <!-- Flat Shipping Charge -->
                        <div class="mb-4">
                            <label for="shipping_charge" class="form-label text-gold-light fw-bold">Flat Shipping Fee (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0">₹</span>
                                <input type="number" step="0.01" name="shipping_charge" id="shipping_charge" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('shipping_charge', \App\Models\Setting::getVal('shipping_charge', '150')) }}" 
                                    required min="0">
                            </div>
                            <small class="text-muted">Standard shipping charge applied to orders that do not meet the free shipping threshold. (Current: ₹{{ number_format((float)\App\Models\Setting::getVal('shipping_charge', '150'), 2) }})</small>
                        </div>

                        <!-- Default GST Rate -->
                        <div class="mb-4">
                            <label for="gst_rate_default" class="form-label text-gold-light fw-bold">Default GST Tax Rate (%)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="gst_rate_default" id="gst_rate_default" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('gst_rate_default', \App\Models\Setting::getVal('gst_rate_default', '18')) }}" 
                                    required min="0" max="100">
                                <span class="input-group-text bg-secondary text-white border-0">%</span>
                            </div>
                            <small class="text-muted">Default GST percentage applied on checkout if a product does not specify its own custom GST rate. (Current: {{\App\Models\Setting::getVal('gst_rate_default', '18')}}%)</small>
                        </div>

                    </div>
                </div>

                <!-- Shiprocket Logistics Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom border-secondary d-flex align-items-center">
                        <h5 class="card-title text-gold mb-0"><i class="fas fa-truck-fast me-2"></i>Shiprocket API Integration</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Shiprocket Account Email -->
                        <div class="mb-4">
                            <label for="shiprocket_email" class="form-label text-gold-light fw-bold">Shiprocket Account Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="shiprocket_email" id="shiprocket_email" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('shiprocket_email', \App\Models\Setting::getVal('shiprocket_email')) }}" 
                                    placeholder="e.g. shipping@ranisahab.com">
                            </div>
                            <small class="text-muted">Email address associated with your Shiprocket merchant account.</small>
                        </div>

                        <!-- Shiprocket Password -->
                        <div class="mb-4">
                            <label for="shiprocket_password" class="form-label text-gold-light fw-bold">Shiprocket Account Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-lock"></i></span>
                                <input type="password" name="shiprocket_password" id="shiprocket_password" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('shiprocket_password', \App\Models\Setting::getVal('shiprocket_password')) }}" 
                                    placeholder="••••••••">
                            </div>
                            <small class="text-muted">Secure password of your Shiprocket account (used to obtain authorization tokens).</small>
                        </div>

                        <!-- Shiprocket Pickup Location -->
                        <div class="mb-4">
                            <label for="shiprocket_pickup_location" class="form-label text-gold-light fw-bold">Shiprocket Pickup Location Nickname</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-location-dot"></i></span>
                                <input type="text" name="shiprocket_pickup_location" id="shiprocket_pickup_location" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('shiprocket_pickup_location', \App\Models\Setting::getVal('shiprocket_pickup_location', 'Primary')) }}" 
                                    placeholder="e.g. Primary, Naveen K">
                            </div>
                            <small class="text-muted">Must exactly match the <strong>Pickup Location Nickname</strong> configured in your Shiprocket account settings (e.g. <code>Primary</code> or <code>Naveen K</code>).</small>
                        </div>

                    </div>
                </div>

                <!-- Google Login Integration Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom border-secondary d-flex align-items-center">
                        <h5 class="card-title text-gold mb-0"><i class="fab fa-google me-2 text-gold"></i>Google OAuth 2.0 Integration</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Google Client ID -->
                        <div class="mb-4">
                            <label for="google_client_id" class="form-label text-gold-light fw-bold">Google Client ID</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fab fa-google"></i></span>
                                <input type="text" name="google_client_id" id="google_client_id" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('google_client_id', \App\Models\Setting::getVal('google_client_id')) }}" 
                                    placeholder="e.g. 123456789-abc123xyz.apps.googleusercontent.com">
                            </div>
                            <small class="text-muted">Enter your Google OAuth 2.0 Client ID from the Google Developer Console.</small>
                        </div>

                        <!-- Google Client Secret -->
                        <div class="mb-4">
                            <label for="google_client_secret" class="form-label text-gold-light fw-bold">Google Client Secret</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-key"></i></span>
                                <input type="password" name="google_client_secret" id="google_client_secret" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('google_client_secret', \App\Models\Setting::getVal('google_client_secret')) }}" 
                                    placeholder="••••••••">
                            </div>
                            <small class="text-muted">Enter your Google OAuth 2.0 Client Secret.</small>
                        </div>

                        <!-- Google Redirect URI -->
                        <div class="mb-4">
                            <label for="google_redirect_uri" class="form-label text-gold-light fw-bold">Authorized Redirect URI</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-link"></i></span>
                                <input type="url" name="google_redirect_uri" id="google_redirect_uri" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('google_redirect_uri', \App\Models\Setting::getVal('google_redirect_uri', url('/customer/auth/google/callback'))) }}">
                            </div>
                            <small class="text-muted">Ensure this exact URL is added to the <strong>Authorized Redirect URIs</strong> list in your Google Cloud Console project credential configuration.</small>
                        </div>

                    </div>
                </div>

                <!-- Store Contact & Social Information Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom border-secondary d-flex align-items-center">
                        <h5 class="card-title text-gold mb-0"><i class="fas fa-headset me-2 text-gold"></i>Store Contact &amp; Social Links</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Store Phone -->
                        <div class="mb-3">
                            <label for="store_phone" class="form-label text-gold-light fw-bold">Support Phone Number</label>
                            <input type="text" name="store_phone" id="store_phone" class="form-control bg-dark text-white border-secondary" value="{{ old('store_phone', \App\Models\Setting::getVal('store_phone', '+91 98765 43210')) }}">
                        </div>

                        <!-- Store WhatsApp -->
                        <div class="mb-3">
                            <label for="store_whatsapp" class="form-label text-gold-light fw-bold">Official WhatsApp Number (Country Code included)</label>
                            <input type="text" name="store_whatsapp" id="store_whatsapp" class="form-control bg-dark text-white border-secondary" value="{{ old('store_whatsapp', \App\Models\Setting::getVal('store_whatsapp', '919876543210')) }}">
                        </div>

                        <!-- Store Support Email -->
                        <div class="mb-3">
                            <label for="store_email" class="form-label text-gold-light fw-bold">Official Support Email</label>
                            <input type="email" name="store_email" id="store_email" class="form-control bg-dark text-white border-secondary" value="{{ old('store_email', \App\Models\Setting::getVal('store_email', 'support@ranisahab.com')) }}">
                        </div>

                        <!-- Business Hours -->
                        <div class="mb-3">
                            <label for="business_hours" class="form-label text-gold-light fw-bold">Business Hours</label>
                            <input type="text" name="business_hours" id="business_hours" class="form-control bg-dark text-white border-secondary" value="{{ old('business_hours', \App\Models\Setting::getVal('business_hours', 'Mon - Sat: 10:00 AM - 8:00 PM IST')) }}">
                        </div>

                        <!-- Flagship Makeup Studio Address -->
                        <div class="mb-3">
                            <label for="makeup_studio_address" class="form-label text-gold-light fw-bold">Flagship Makeup Studio Address</label>
                            <input type="text" name="makeup_studio_address" id="makeup_studio_address" class="form-control bg-dark text-white border-secondary" value="{{ old('makeup_studio_address', \App\Models\Setting::getVal('makeup_studio_address', '1st Floor, GK-1, New Delhi, India')) }}">
                        </div>

                        <!-- Makeup Travel Availability -->
                        <div class="mb-3">
                            <label for="makeup_travel_availability" class="form-label text-gold-light fw-bold">Makeup Travel Availability Description</label>
                            <textarea name="makeup_travel_availability" id="makeup_travel_availability" class="form-control bg-dark text-white border-secondary" rows="2">{{ old('makeup_travel_availability', \App\Models\Setting::getVal('makeup_travel_availability', 'Our senior celebrity makeup artists are fully available to travel directly to your wedding venue, resort, or home location anywhere in India or internationally.')) }}</textarea>
                        </div>

                        <!-- Makeup Serviceable Locations -->
                        <div class="mb-3">
                            <label for="makeup_serviceable_locations" class="form-label text-gold-light fw-bold">Makeup Serviceable Locations / Cities (Comma-separated)</label>
                            <input type="text" name="makeup_serviceable_locations" id="makeup_serviceable_locations" class="form-control bg-dark text-white border-secondary" value="{{ old('makeup_serviceable_locations', \App\Models\Setting::getVal('makeup_serviceable_locations', 'Delhi-NCR, Mumbai, Jaipur, Udaipur')) }}" placeholder="e.g. Delhi-NCR, Mumbai, Jaipur, Udaipur">
                            <small class="text-muted">Enter the list of cities where makeup services are available on-location.</small>
                        </div>

                        <!-- Instagram URL -->
                        <div class="mb-3">
                            <label for="instagram_url" class="form-label text-gold-light fw-bold">Instagram URL</label>
                            <input type="url" name="instagram_url" id="instagram_url" class="form-control bg-dark text-white border-secondary" value="{{ old('instagram_url', \App\Models\Setting::getVal('instagram_url', 'https://instagram.com/ranisahabofficial')) }}">
                        </div>

                        <!-- Facebook URL -->
                        <div class="mb-3">
                            <label for="facebook_url" class="form-label text-gold-light fw-bold">Facebook URL</label>
                            <input type="url" name="facebook_url" id="facebook_url" class="form-control bg-dark text-white border-secondary" value="{{ old('facebook_url', \App\Models\Setting::getVal('facebook_url', 'https://facebook.com/ranisahabofficial')) }}">
                        </div>

                    </div>
                </div>

                <!-- Google Maps Autocomplete Integration Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header border-bottom border-secondary d-flex align-items-center">
                        <h5 class="card-title text-gold mb-0"><i class="fas fa-map-location-dot me-2 text-gold"></i>Google Maps Integration</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Google Maps API Key -->
                        <div class="mb-4">
                            <label for="google_maps_api_key" class="form-label text-gold-light fw-bold">Google Maps API Key</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary text-white border-0"><i class="fas fa-key"></i></span>
                                <input type="password" name="google_maps_api_key" id="google_maps_api_key" 
                                    class="form-control bg-dark text-white border-secondary" 
                                    value="{{ old('google_maps_api_key', \App\Models\Setting::getVal('google_maps_api_key')) }}" 
                                    placeholder="••••••••">
                            </div>
                            <small class="text-muted">Enter your Google Maps API Key. Make sure to enable the <strong>Places API</strong> and <strong>Maps JavaScript API</strong> in your Google Cloud Console.</small>
                        </div>

                    </div>
                </div>

                <!-- Unified Form Footer Actions -->
                <div class="card bg-transparent border-0 d-flex flex-row justify-content-end gap-2 mb-4 p-0">
                    <button type="reset" class="btn btn-outline-secondary text-white rounded-pill px-4">Reset Fields</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">
                        <i class="fas fa-save me-2"></i>Save Configuration
                    </button>
                </div>
                
            </form>
        </div>
        
        <!-- Helpful Information side box -->
        <div class="col-lg-6 col-md-4 col-12">
            <div class="card bg-transparent border-warning border-opacity-25 shadow-none mb-4">
                <div class="card-body">
                    <h6 class="text-gold fw-bold mb-3"><i class="fas fa-circle-info me-2"></i>Configuration Guidance</h6>
                    <ul class="text-muted small ps-3" style="line-height: 1.8;">
                        <li><strong>Free Shipping:</strong> Set the threshold value to <code>0</code> if you want to provide unconditionally free shipping to all orders.</li>
                        <li><strong>GST Application:</strong> Individual products can have their own specific GST rates. The value configured here only serves as the fallback default.</li>
                        <li><strong>Activity Audits:</strong> Every change made to these values is automatically logged under admin activity audits for compliance and transparency.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
