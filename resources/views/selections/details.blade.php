@extends('layouts.app')
@section('page-css')
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/table-datatable.css">
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Seleksi Atlet</h3>
                        <p class="text-subtitle text-muted">Daftar Peserta</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Peserta</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div>
                            @if ($status == 1)
                                <form class="d-inline" action="{{ url('selections/details/close') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-danger" type="submit" name="id"
                                        value="{{ $selection_id }}">Tutup
                                        Pengajuan</button>
                                </form>
                            @endif
                            <button type="button" class="d-inline btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#setuptest">
                                <i class="bi bi-gear"></i> Tes
                            </button>
                        </div>
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
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Cabang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->athletes->nama }}</td>
                                        <td>
                                            @php
                                                $birthdate = $data->athletes->tgl_lahir;
                                                $age = \Carbon\Carbon::parse($birthdate)->age;
                                            @endphp
                                            {{ $age }} Tahun
                                        </td>
                                        <td>{{ $data->athletes->jenis_kelamin }}</td>
                                        <td>{{ $data->branches->cabang }}</td>
                                        <td>
                                            <form action="{{ url('selections/details/del') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn icon btn-sm btn-danger" type="submit" name="id"
                                                    value="{{ $data->id }}"><i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('modal')
    @if ($tests->count() == 0)
        <div class="modal fade text-left" id="setuptest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Kelola Tes</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ url('selections/details/setuptest') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="coach_id">Pilih pelatih penilai: </label>
                            <div class="form-group">
                                <select class="form-select" name="coach_id" id="coach_id">
                                    <option value="" selected>-- Pilih Pelatih --</option>
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}">
                                            {{ $coach->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal" name="selection_id"
                                value="{{ $selection_id }}">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade text-left" id="setuptest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Kelola Tes</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ url('selections/details/edittest') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="coach_id">Pilih pelatih penilai: </label>
                            <div class="form-group">
                                <select class="form-select" name="coach_id" id="coach_id">
                                    <option value="" selected>-- Pilih Pelatih --</option>
                                    @foreach ($coaches as $coach)
                                        <option value="{{ $coach->id }}"
                                            @if ($coach->id == $coach_id) selected @endif>
                                            {{ $coach->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="status">Status penilaian: </label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"
                                        value="1" @if ($statusp == 1) checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Aktif
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"
                                        value="2" @if ($statusp == 2) checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Non Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal" name="id"
                                value="{{ $test_id }}">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page-js')
    <script src="{{ url_plug() }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/simple-datatables.js"></script>
@endsection
