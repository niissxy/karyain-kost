@extends('layouts.auth')

@section('content')

<style>
    body {
    overflow-x: hidden;
    background: linear-gradient(135deg, #ff5757, #c59999);
}

.auth-logo {
    width: 70px;
    height: auto;
}
</style>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <div class="card shadow-sm border-0 rounded-4">

                <!-- Header -->
                <!-- Header -->
                <div class="card-header text-center rounded-top-4">

                <!-- Logo -->
                    <img src="{{ asset('assets/img/logo-kost.png') }}"
                    alt="Logo"
                    class="mb-2 auth-logo">

                <!-- Title -->
                <div class="fs-4 fw-bold">
                    {{ __('Login') }}
                </div>
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

                        <button type="submit" id="btn-login" class="btn btn-primary w-100 py-2 fw-semibold">
                            Login
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}" id="btn-register" class="fw-semibold">Register</a><br>
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

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $(".btn-login").click(function() {

            var name = $("#name").val();
            var password = $("#password").val();
            var token = $("meta[name='csrf-token']").attr("content");

            if (name.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Name Wajib Diisi!'
                });

            } else if (password.length == "") {

                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Password Wajib Diisi!'
                });

            } else {

                $.ajax({

                    url: "{{ url('login') }}",
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    data: {
                        "name": name,
                        "password": password,
                        "_token": token
                    },

                    success: function(response) {

                        if (response.success) {

                            Swal.fire({
                                    type: 'success',
                                    title: 'Login Berhasil!',
                                    text: 'Anda akan diarahkan dalam 3 Detik',
                                    icon: 'success',
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
                                .then(function() {
                                    window.location.href =
                                        "{{ route('dashboard') }}";
                                });

                        }
                    },

                    error: function(response) {

                        Swal.fire({
                                type: 'error',
                                title: 'Login Gagal!',
                                text: 'Username / Password Salah'
                            });

                        console.log(response);

                    }

                });

            }

        });

        $(document).on("keypress", function(e) {
            if (e.which == 13) {
                $("#btn-login").click();
            }
        });

    });
</script>