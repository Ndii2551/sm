@extends('layouts.app')

@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3 class="h3">Akun</h3>
                        <p class="text-subtitle text-muted">Pengaturan Akun</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Akun</li>
                                <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Profil Akun</h5>
                    <p class="text-subtitle text-muted">Pengaturan profil dan email anda.</p>
                </div>
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Nama Profil')" />
                            <x-text-input id="name" name="name" type="text" class="form-control"
                                :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Alamat Email')" />
                            <x-text-input id="email" name="email" type="email" class="form-control"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Email anda belum terverifikasi.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Klik disini untul mengirim kembali email verifikasi.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('Link verifikasi yang baru telah dikirim ke alamat email anda.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="btn btn-primary" type="submit">{{ __('Simpan') }}</button>

                            @if (session('status') === 'profile-updated')
                                <div class="alert alert-success alert-dismissible show fade mt-3">
                                    <strong>Berhasil!</strong>
                                    Perubahan anda tersimpan.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ubah Password</h5>
                    <p class="text-subtitle text-muted">Pastikan anda menggunakan password yang kuat agar tetap aman.</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" />
                            <x-text-input id="update_password_current_password" name="current_password" type="password"
                                class="form-control" autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="update_password_password" :value="__('Password Baru')" />
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control"
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="btn btn-primary" type="submit">{{ __('Simpan') }}</button>

                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success alert-dismissible show fade mt-3">
                                    <strong>Berhasil!</strong>
                                    Perubahan anda tersimpan.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div> --}}
        </section>
    </div>
@endsection
