@extends('layouts.auth')

@section('content')

<style>
    body {
    overflow-x: hidden; /* cegah scroll horizontal */
}

html, body {
    max-width: 100vw; /* pastikan tidak lebih dari lebar viewport */
}

</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">
                
                <!-- Header -->
                <div class="card-header text-center text-black fs-4 fw-bold rounded-top-4">
                    {{ __('Register') }}
                </div>

                <div class="card-body p-4">

                    <!-- Google Sign Up -->
                    <a href="{{ url('/auth/google') }}" class="btn btn-danger w-100 mb-3 d-flex align-items-center justify-content-center">
                        <i class="fab fa-google me-2"></i> Sign Up dengan Google
                    </a>

                    <!-- Separator -->
                    <div class="text-center my-3 text-muted">atau daftar dengan email</div>

                    <!-- Form Register -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
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

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mb-2">
                            {{ __('Register') }}
                        </button>

                        <!-- Link Login -->
                        @if (Route::has('login'))
                            <div class="text-center mt-3">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-primary">Login di sini</a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
