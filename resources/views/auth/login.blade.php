<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FAJI Banten | Seleksi Atlet</title>
    <link rel="shortcut icon" href="{{ url_plug() }}/assets/favicon/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/auth.css">
</head>

<body>
    <script src="{{ url_plug() }}/assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Sistem Informasi Pengolahan Data Seleksi Atlet</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        {{-- Email --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" id="email" class="form-control form-control-xl"
                                placeholder="Email" name="email" :value="old('email')" required autofocus
                                autocomplete="username">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        {{-- Password --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" id="password" class="form-control form-control-xl"
                                placeholder="Password" name="password" required autocomplete="current-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        {{-- Remember Me --}}
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" id="remember_me" type="checkbox" name="remember">
                            <label class="form-check-label text-gray-600" for="remember_me">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"
                    style="background-image: url('{{ url_plug() }}/assets/compiled/png/carousel3.jpg');background-repeat: no-repeat;height: 100%;background-size: cover;">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
