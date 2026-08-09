@extends('layouts.app')

@section('title', 'Address Book — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="customer-dashboard-wrapper py-5">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                @include('customer.layouts.sidebar')
            </div>
            
            <!-- Addresses Book Content -->
            <div class="col-lg-9 col-md-8">
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Left: Addresses Grid -->
                    <div class="col-lg-7">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-map-location-dot me-2 text-gold"></i>Saved Addresses
                            </h4>
                            
                            @if ($addresses->isEmpty())
                                <div class="text-center py-5">
                                    <i class="fa-solid fa-location-dot text-muted mb-2" style="font-size: 2.5rem;"></i>
                                    <p class="mb-0 text-muted">No saved addresses found. Please add a shipping/billing address on the right.</p>
                                </div>
                            @else
                                <div class="row g-3">
                                    @foreach ($addresses as $address)
                                        <div class="col-12">
                                            <div class="p-3 border rounded @if($address->is_default) border-warning bg-light bg-opacity-10 @endif position-relative">
                                                
                                                @if($address->is_default)
                                                    <span class="badge bg-gold text-dark position-absolute top-0 end-0 m-3" style="font-size:0.6rem; letter-spacing:0.05em;">
                                                        <i class="fa-solid fa-star me-1"></i> DEFAULT SHIPPING
                                                    </span>
                                                @endif
                                                
                                                <h6 class="font-display mb-2 text-dark" style="font-weight:700;">Address Details</h6>
                                                
                                                <p class="mb-1 text-secondary small" style="line-height:1.5;">
                                                    {{ $address->address_line_1 }}<br>
                                                    @if($address->address_line_2) {{ $address->address_line_2 }}<br> @endif
                                                    {{ $address->city }}, {{ $address->state }} — {{ $address->postal_code }}<br>
                                                    {{ $address->country }}
                                                </p>
                                                
                                                <div class="mt-3 pt-2 border-top d-flex gap-2">
                                                    @if(!$address->is_default)
                                                        <form action="{{ route('customer.addresses.default', $address->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-secondary py-1" style="font-size:0.65rem;">
                                                                <i class="fa-solid fa-check me-1 text-success"></i> Set as Default
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <button type="button" class="btn btn-sm btn-outline-secondary py-1" style="font-size:0.65rem;" data-bs-toggle="collapse" data-bs-target="#editAddressForm{{ $address->id }}">
                                                        <i class="fa-solid fa-pencil me-1 text-primary"></i> Edit
                                                    </button>
                                                    
                                                    <form action="{{ route('customer.addresses.destroy', $address->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary py-1" style="font-size:0.65rem;">
                                                            <i class="fa-solid fa-trash-can me-1 text-danger"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Collapsible Edit Address form -->
                                                <div class="collapse mt-3 border-top pt-3" id="editAddressForm{{ $address->id }}">
                                                    <h6 class="font-display text-maroon mb-2" style="font-weight:600;">Edit Address Details</h6>
                                                    <form action="{{ route('customer.addresses.update', $address->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="mb-2 luxury-input-group d-flex flex-column">
                                                            <label for="address_line_1_{{ $address->id }}" style="font-size:0.6rem;">Address Line 1</label>
                                                            <input type="text" name="address_line_1" id="address_line_1_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->address_line_1 }}" required>
                                                        </div>

                                                        <div class="mb-2 luxury-input-group d-flex flex-column">
                                                            <label for="address_line_2_{{ $address->id }}" style="font-size:0.6rem;">Address Line 2 (Optional)</label>
                                                            <input type="text" name="address_line_2" id="address_line_2_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->address_line_2 }}">
                                                        </div>

                                                        <div class="row g-2 mb-2">
                                                            <div class="col-6">
                                                                <div class="luxury-input-group d-flex flex-column">
                                                                    <label for="city_{{ $address->id }}" style="font-size:0.6rem;">City</label>
                                                                    <input type="text" name="city" id="city_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->city }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="luxury-input-group d-flex flex-column">
                                                                    <label for="state_{{ $address->id }}" style="font-size:0.6rem;">State</label>
                                                                    <input type="text" name="state" id="state_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->state }}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-2 mb-2">
                                                            <div class="col-6">
                                                                <div class="luxury-input-group d-flex flex-column">
                                                                    <label for="postal_code_{{ $address->id }}" style="font-size:0.6rem;">Postal Code</label>
                                                                    <input type="text" name="postal_code" id="postal_code_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->postal_code }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="luxury-input-group d-flex flex-column">
                                                                    <label for="country_{{ $address->id }}" style="font-size:0.6rem;">Country</label>
                                                                    <input type="text" name="country" id="country_{{ $address->id }}" class="luxury-input form-control py-1 px-2" value="{{ $address->country }}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 form-check text-start">
                                                            <input type="checkbox" name="is_default" id="is_default_{{ $address->id }}" class="form-check-input" value="1" @if($address->is_default) checked @endif>
                                                            <label class="form-check-label small" for="is_default_{{ $address->id }}">Set as default address</label>
                                                        </div>

                                                        <button type="submit" class="btn btn-dark btn-sm py-1 px-3" style="font-size:0.65rem; border:1px solid var(--gold); color:var(--gold-light);">
                                                            UPDATE ADDRESS
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Add New Address -->
                    <div class="col-lg-5">
                        <div class="dashboard-card">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-circle-plus me-2 text-gold"></i>New Address
                            </h4>
                            
                            <form action="{{ route('customer.addresses.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="new_address_line_1">Address Line 1</label>
                                    <input type="text" name="address_line_1" id="new_address_line_1" class="luxury-input form-control" placeholder="101, Luxury Heights Apartment" value="{{ old('address_line_1') }}" required>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="new_address_line_2">Address Line 2 (Optional)</label>
                                    <input type="text" name="address_line_2" id="new_address_line_2" class="luxury-input form-control" placeholder="MG Road, Cross Street" value="{{ old('address_line_2') }}">
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="new_city">City</label>
                                            <input type="text" name="city" id="new_city" class="luxury-input form-control" placeholder="Mumbai" value="{{ old('city') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="new_state">State</label>
                                            <input type="text" name="state" id="new_state" class="luxury-input form-control" placeholder="Maharashtra" value="{{ old('state') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="new_postal_code">Postal Code</label>
                                            <input type="text" name="postal_code" id="new_postal_code" class="luxury-input form-control" placeholder="400001" value="{{ old('postal_code') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="luxury-input-group d-flex flex-column">
                                            <label for="new_country">Country</label>
                                            <input type="text" name="country" id="new_country" class="luxury-input form-control" placeholder="India" value="{{ old('country', 'India') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 form-check text-start">
                                    <input type="checkbox" name="is_default" id="new_is_default" class="form-check-input" value="1">
                                    <label class="form-check-label text-gold-dark small" for="new_is_default" style="font-weight:600;">Set as default shipping address</label>
                                </div>

                                <button type="submit" class="btn-gold w-100 py-2">
                                    ADD ADDRESS <i class="fa-solid fa-plus ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
