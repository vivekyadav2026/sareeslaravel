@extends('layouts.app')

@section('title', 'Recover Password — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="auth-page-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="auth-card">
                    <h2 class="auth-card-title">Reset Password</h2>
                    <p class="auth-card-subtitle">Enter your email to receive recovery instructions</p>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show bg-transparent border-success text-success mb-4" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close class-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
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

                    <form action="{{ route('customer.password.email') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="auth-form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control auth-form-input" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email" autofocus>
                        </div>

                        <button type="submit" class="btn-gold w-100 py-3 mb-4">
                            SEND RESET LINK <i class="fa-solid fa-paper-plane ms-1"></i>
                        </button>
                    </form>

                    <div class="text-center pt-3 border-top border-secondary border-opacity-25 mt-2">
                        <p class="mb-0 small text-muted" style="font-size:0.75rem;">REMEMBER PASSWORD?</p>
                        <a href="{{ route('customer.login') }}" class="text-gold-light font-display fs-6" style="font-weight:600; letter-spacing:0.05em;">RETURN TO SIGN IN <i class="fa-solid fa-arrow-left-long ms-1 fs-6"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
