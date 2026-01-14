@extends('layouts.auth')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <div class="card shadow-sm border-0 rounded-4">

                <!-- Header -->
                <div class="card-header text-center fs-4 fw-bold rounded-top-4">
                    {{ __('Login') }}
                </div>

                <div class="card-body p-4">

                    <!-- Google Login -->
                    <a href="{{ route('google.login') }}"
                       class="btn btn-danger w-100 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-google me-2"></i> Login dengan Google
                    </a>

                    <!-- Separator -->
                    <div class="text-center my-3 text-muted">atau login dengan email</div>

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            Login
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}" class="fw-semibold">Register</a><br>
                            <a href="{{ route('password.request') }}" class="text-muted small">
                                Lupa Password?
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
