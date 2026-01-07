@extends('layouts.auth') <!-- Gunakan layout auth agar sidebar tidak muncul -->

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-center text-black fs-4 fw-bold rounded-top-4">
                    {{ __('Login') }}
                </div>

                <div class="card-body p-4">

                    <!-- Google Login -->
                    <a href="{{ url('/auth/google') }}" class="btn btn-danger w-100 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-google me-2"></i> Login dengan Google
                    </a>

                    <!-- Separator -->
                    <div class="text-center my-3 text-muted">atau login dengan email</div>

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-2">
                            {{ __('Login') }}
                        </button>

                        <!-- Links -->
                        <div class="text-center mt-2">
                            @if (Route::has('register'))
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Register di sini</a>
                            @endif
                            <br>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
