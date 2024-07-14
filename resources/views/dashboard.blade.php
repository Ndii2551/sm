@extends('layouts.app')
@section('page-css')
    {{-- choices --}}
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/choices.js/public/assets/styles/choices.css">

    {{-- file uploader --}}
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ url_plug() }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/toastify-js/src/toastify.css">
@endsection
@section('content')
    @if (Auth::user()->role_id == 5)
        @include('guest')
    @else
        <div id="main-content" style="min-height: 100vh">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Dashboard</h3>
                            <p class="text-subtitle text-muted">Beranda</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="alert alert-success alert-dismissible show fade mt-3">
                        <strong>Selamat Datang!</strong>
                        {{ Auth::user()->name }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @if (Auth::user()->role_id == 1)
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Pengurus Cabang Aktif</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $branchesc }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Pelatih Aktif</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $coachesc }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Atlet Aktif</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $athletesc }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Total Pengguna Aktif</h6>
                                                    <h6 class="font-extrabold mb-0">
                                                        {{ $branchesc + $coachesc + $athletesc }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-primary">
                            Silahkan pilih menu yang tersedia pada sidebar.
                        </div>
                    @endif
                </section>
            </div>

        </div>
    @endif
@endsection
@section('page-js')
    {{-- choices --}}
    <script src="{{ url_plug() }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/form-element-select.js"></script>

    {{-- file uploader --}}
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js">
    </script>
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond/filepond.js"></script>
    <script src="{{ url_plug() }}/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/filepond.js"></script>
    <script>
        FilePond.create(document.querySelector(".basic-filepond2"), {
            credits: null,
            allowImagePreview: false,
            allowMultiple: false,
            allowFileEncode: false,
            required: false,
            storeAsFile: true,
        });
    </script>

    {{-- dashboard --}}
    <script src="{{ url_plug() }}/assets/static/js/pages/dashboard.js"></script>
@endsection
