@extends('layouts.app')

@section('title', 'Customer Login — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="auth-page-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="auth-card">
                    <h2 class="auth-card-title">Welcome Back</h2>
                    <p class="auth-card-subtitle">Sign in to your luxury boutique account</p>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show bg-transparent border-success text-success mb-4" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

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

                    <form action="{{ route('customer.login.submit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="auth-form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control auth-form-input" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email" autofocus>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="auth-form-label mb-0">Password</label>
                                <a href="{{ route('customer.password.request') }}" class="text-gold-light" style="font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase;">Forgot Password?</a>
                            </div>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control auth-form-input pe-5" placeholder="••••••••" required autocomplete="current-password">
                                <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password', this)" style="background: none; box-shadow: none;">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 form-check text-start">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gold-light" for="remember" style="font-size: 0.72rem; letter-spacing: 0.05em; text-transform: uppercase;">Remember me on this device</label>
                        </div>

                        <button type="submit" class="btn-gold w-100 py-3 mb-4">
                            SIGN IN <i class="fa-solid fa-right-to-bracket ms-1"></i>
                        </button>
                    </form>

                    <div class="text-center pt-3 border-top border-secondary border-opacity-25 mt-2">
                        <p class="mb-0 small text-muted" style="font-size:0.75rem;">DON'T HAVE AN ACCOUNT?</p>
                        <a href="{{ route('customer.register') }}" class="text-gold-light font-display fs-6" style="font-weight:600; letter-spacing:0.05em;">CREATE BOUTIQUE ACCOUNT <i class="fa-solid fa-arrow-right-long ms-1 fs-6"></i></a>
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
