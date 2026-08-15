@extends('layouts.app')

@section('title', 'Reset Password — RANISAHAB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="auth-page-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="auth-card">
                    <h2 class="auth-card-title">New Password</h2>
                    <p class="auth-card-subtitle">Set your new royal security password</p>
                    
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

                    <form action="{{ route('customer.password.update') }}" method="POST">
                         @csrf
                         <input type="hidden" name="token" value="{{ $token }}">
                         
                         <div class="mb-4">
                             <label for="email" class="auth-form-label">Email Address</label>
                             <input type="email" name="email" id="email" class="form-control auth-form-input" value="{{ $email ?? old('email') }}" readonly required autocomplete="email">
                         </div>

                         <div class="mb-4">
                             <label for="password" class="auth-form-label">New Password</label>
                             <div class="position-relative">
                                 <input type="password" name="password" id="password" class="form-control auth-form-input pe-5" placeholder="Min. 8 characters" required autofocus>
                                 <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password', this)" style="background: none; box-shadow: none;">
                                     <i class="fa-solid fa-eye"></i>
                                 </button>
                             </div>
                         </div>

                         <div class="mb-4">
                             <label for="password_confirmation" class="auth-form-label">Confirm New Password</label>
                             <div class="position-relative">
                                 <input type="password" name="password_confirmation" id="password_confirmation" class="form-control auth-form-input pe-5" placeholder="Repeat new password" required>
                                 <button type="button" class="btn border-0 text-gold position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePasswordVisibility('password_confirmation', this)" style="background: none; box-shadow: none;">
                                     <i class="fa-solid fa-eye"></i>
                                 </button>
                             </div>
                         </div>

                         <button type="submit" class="btn-gold w-100 py-3 mb-4">
                             UPDATE PASSWORD <i class="fa-solid fa-key ms-1"></i>
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
