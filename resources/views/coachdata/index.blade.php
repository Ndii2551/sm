@extends('layouts.app')
@section('page-css')
    <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css">
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Informasi Pribadi</h3>
                        <p class="text-subtitle text-muted">Data Pelatih</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Informasi Pribadi</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pelatih</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    @if ($datas->count() == 0)
                        <div class="card-header">
                            <div class="alert alert-danger">
                                <strong>Perhatian!</strong>
                                Data pelatih belum diisi.
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ url('coachdata/store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="nama">Nama Lengkap</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                                        id="nama" value="{{ Auth::user()->name }}" disabled>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <!-- Auto crop image file uploader -->
                                                <label for="pasfoto">Upload Pas Foto</label>
                                                <input type="file" class="image-crop-filepond"
                                                    image-crop-aspect-ratio="3:4" id="pasfoto" name="pasfoto"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Tempat Lahir"
                                                        id="tempat_lahir" name="tempat_lahir">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-geo-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                <div class="position-relative">
                                                    <input type="date" class="form-control" placeholder="Tanggal Lahir"
                                                        id="tgl_lahir" name="tgl_lahir">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label>Jenis Kelamin</label>
                                                <div class="d-flex">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                            id="flexRadioDefault1" value="Laki-laki">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Laki-laki
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-3">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                            id="flexRadioDefault2" value="Perempuan">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="no_hp">Nomor Handphone</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                        placeholder="Nomor Handphone" id="no_hp" name="no_hp">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="no_nik">Nomor Induk Kependudukan</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="NIK"
                                                        id="no_nik" name="no_nik">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-card-heading"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="no_kk">Nomor Kartu Keluarga</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Nomor KK"
                                                        id="no_kk" name="no_kk">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-card-heading"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <!-- Basic file uploader -->
                                                <label for="f_ktp">Upload KTP</label>
                                                <input type="file" class="basic-filepond" id="f_ktp"
                                                    name="f_ktp" accept="image/*,application/pdf,">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <!-- Basic file uploader -->
                                                <label for="f_kk">Upload Kartu Keluarga</label>
                                                <input type="file" class="basic-filepond2" id="f_kk"
                                                    name="f_kk" accept="image/*,application/pdf,">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="user_id"
                                                value="{{ Auth::user()->id }}">Simpan</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-header">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade mt-3">
                                    <strong>Berhasil!</strong>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ url('coachdata/update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @foreach ($datas as $data)
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Nama Lengkap" id="nama"
                                                            value="{{ Auth::user()->name }}" disabled>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- Auto crop image file uploader -->
                                                    <label for="pasfoto">Upload Pas Foto</label>
                                                    <input type="file" class="image-crop-filepond"
                                                        image-crop-aspect-ratio="3:4" id="pasfoto" name="pasfoto"
                                                        accept="image/*">
                                                </div>
                                                <a class="btn btn-sm btn-secondary mb-2"
                                                    href="{{ asset('uploads/dokumen_pelatih/' . $data->pasfoto) }}">
                                                    <i class="bi bi-eye"></i> Lihat Pas Foto
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Tempat Lahir" id="tempat_lahir"
                                                            name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                                    <div class="position-relative">
                                                        <input type="date" class="form-control"
                                                            placeholder="Tanggal Lahir" id="tgl_lahir" name="tgl_lahir"
                                                            value="{{ $data->tgl_lahir }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label>Jenis Kelamin</label>
                                                    <div class="d-flex">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_kelamin" id="flexRadioDefault1"
                                                                value="Laki-laki"
                                                                @if ($data->jenis_kelamin == 'Laki-laki') checked @endif>
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Laki-laki
                                                            </label>
                                                        </div>
                                                        <div class="form-check ms-3">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_kelamin" id="flexRadioDefault2"
                                                                value="Perempuan"
                                                                @if ($data->jenis_kelamin == 'Perempuan') checked @endif>
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ $data->alamat }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="no_hp">Nomor Handphone</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control"
                                                            placeholder="Nomor Handphone" id="no_hp" name="no_hp"
                                                            value="{{ $data->no_hp }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-phone"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="no_nik">Nomor Induk Kependudukan</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="NIK"
                                                            id="no_nik" name="no_nik" value="{{ $data->no_nik }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-card-heading"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="no_kk">Nomor Kartu Keluarga</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Nomor KK"
                                                            id="no_kk" name="no_kk" value="{{ $data->no_kk }}">
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-card-heading"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- Basic file uploader -->
                                                    <label for="f_ktp">Upload KTP</label>
                                                    <input type="file" class="basic-filepond" id="f_ktp"
                                                        name="f_ktp" accept="image/*,application/pdf,">
                                                </div>
                                                <a class="btn btn-sm btn-secondary mb-2"
                                                    href="{{ asset('uploads/dokumen_pelatih/' . $data->f_ktp) }}">
                                                    <i class="bi bi-eye"></i> Lihat KTP
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- Basic file uploader -->
                                                    <label for="f_kk">Upload Kartu Keluarga</label>
                                                    <input type="file" class="basic-filepond2" id="f_kk"
                                                        name="f_kk" accept="image/*,application/pdf,">
                                                </div>
                                                <a class="btn btn-sm btn-secondary mb-2"
                                                    href="{{ asset('uploads/dokumen_pelatih/' . $data->f_kk) }}">
                                                    <i class="bi bi-eye"></i> Lihat KK
                                                </a>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                                                <button type="submit" class="btn btn-primary me-1 mb-1" name="id"
                                                    value="{{ $data->id }}">Simpan</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    @endif
                </div>
            </section>
        </div>

    </div>
@endsection

@section('modal')
@endsection

@section('page-js')
    {{-- file uploader --}}
    <script src="assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="assets/extensions/filepond/filepond.js"></script>
    <script src="assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="assets/static/js/pages/filepond.js"></script>
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
@endsection
