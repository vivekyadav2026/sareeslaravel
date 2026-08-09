@extends('layouts.app')

@section('title', 'Profile Settings — RANISAHAB')

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
            
            <!-- Profile Settings Content -->
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
                    <!-- Edit Profile Details -->
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card h-100">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-user-pen me-2 text-gold"></i>Personal Details
                            </h4>
                            
                            <form action="{{ route('customer.profile.update') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="luxury-input form-control" value="{{ old('first_name', $customer->first_name) }}" required>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="luxury-input form-control" value="{{ old('last_name', $customer->last_name) }}" required>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" class="luxury-input form-control text-muted" value="{{ $customer->email }}" disabled style="background:#f8f9fa;">
                                    <small class="text-muted mt-1" style="font-size:0.7rem;"><i class="fa-solid fa-info-circle me-1"></i>Email address cannot be changed</small>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="luxury-input form-control" value="{{ old('phone', $customer->phone) }}" placeholder="9876543210">
                                </div>

                                <button type="submit" class="btn-gold py-2 px-4">
                                    SAVE DETAILS <i class="fa-solid fa-save ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="col-lg-6 mb-4">
                        <div class="dashboard-card h-100">
                            <h4 class="font-display text-maroon mb-3 border-bottom pb-2" style="font-weight:700;">
                                <i class="fa-solid fa-lock-open me-2 text-gold"></i>Change Password
                            </h4>
                            
                            <form action="{{ route('customer.profile.password') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="current_password">Current Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="current_password" id="current_password" class="luxury-input form-control pe-5" placeholder="••••••••" required>
                                        <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('current_password', this)" style="background: none; box-shadow: none;">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3 luxury-input-group d-flex flex-column">
                                    <label for="password">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password" class="luxury-input form-control pe-5" placeholder="Min. 8 characters" required>
                                        <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password', this)" style="background: none; box-shadow: none;">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4 luxury-input-group d-flex flex-column">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="luxury-input form-control pe-5" placeholder="Repeat new password" required>
                                        <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password_confirmation', this)" style="background: none; box-shadow: none;">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-gold py-2 px-4">
                                    UPDATE PASSWORD <i class="fa-solid fa-key ms-1"></i>
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
