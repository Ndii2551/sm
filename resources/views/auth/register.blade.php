<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FAJI Banten | Seleksi Atlet</title>
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
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Registrasikan diri anda agar terdata sebagai atlet arung jeram
                        Provinsi Banten.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{-- Name --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" id="name" class="form-control form-control-xl"
                                placeholder="Nama Lengkap" name="name" :value="old('name')" required autofocus
                                autocomplete="name">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                        {{-- Email --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email"
                                name="email" :value="old('email')" required autocomplete="username">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        {{-- Password --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        {{-- Confirm Password --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl"
                                placeholder="Konfirmasi Password" name="password_confirmation" required
                                autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}"
                                class="font-bold">Log
                                in</a>.</p>
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
