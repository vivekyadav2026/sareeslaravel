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
