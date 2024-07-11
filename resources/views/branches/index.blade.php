@extends('layouts.app')
@section('page-css')
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable.css">
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Kelola Data</h3>
                        <p class="text-subtitle text-muted">Pengurus Cabang</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kelola Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Pengurus Cabang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
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
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>Cabang</th>
                                    <th>Nomor SK Pengurus</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->cabang }}</td>
                                        <td>{{ $data->no_sk }}</td>
                                        <td>
                                            @if ($data->status == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn icon btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#{{ $data->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <div class="modal fade text-left" id="{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Ubah Data</h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('branches/update') }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <label for="cabang">Cabang: </label>
                                                                <div class="form-group">
                                                                    <select class="form-select" name="cabang"
                                                                        id="cabang">
                                                                        <option value="Kabupaten Serang"
                                                                            @if ($data->cabang == 'Kabupaten Serang') selected @endif>
                                                                            Kabupaten
                                                                            Serang</option>
                                                                        <option value="Kota Serang"
                                                                            @if ($data->cabang == 'Kota Serang') selected @endif>
                                                                            Kota Serang
                                                                        </option>
                                                                        <option value="Kabupaten Pandeglang"
                                                                            @if ($data->cabang == 'Kabupaten Pandeglang') selected @endif>
                                                                            Kabupaten
                                                                            Pandeglang</option>
                                                                        <option value="Kabupaten Lebak"
                                                                            @if ($data->cabang == 'Kabupaten Lebak') selected @endif>
                                                                            Kabupaten
                                                                            Lebak</option>
                                                                        <option value="Kabupaten Tangerang"
                                                                            @if ($data->cabang == 'Kabupaten Tangerang') selected @endif>
                                                                            Kabupaten
                                                                            Tangerang</option>
                                                                        <option value="Kota Tangerang"
                                                                            @if ($data->cabang == 'Kota Tangerang') selected @endif>
                                                                            Kota Tangerang
                                                                        </option>
                                                                        <option value="Kota Tangerang Selatan"
                                                                            @if ($data->cabang == 'Kota Tangerang Selatan') selected @endif>
                                                                            Kota Tangerang
                                                                            Selatan
                                                                        </option>
                                                                        <option value="Kota Cilegon"
                                                                            @if ($data->cabang == 'Kota Cilegon') selected @endif>
                                                                            Kota Cilegon
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <label for="no_sk">Nomor SK Pengurus: </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Nomor SK Pengurus" id="no_sk"
                                                                        name="no_sk" value="{{ $data->no_sk }}">
                                                                </div>
                                                                <label for="status">Status: </label>
                                                                <div class="d-flex">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" id="flexRadioDefault1"
                                                                            value="1"
                                                                            @if ($data->status == 1) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault1">
                                                                            Aktif
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check ms-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" id="flexRadioDefault2"
                                                                            value="2"
                                                                            @if ($data->status == 2) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="flexRadioDefault2">
                                                                            Non Aktif
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="reset" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Batal</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ms-1"
                                                                    data-bs-dismiss="modal" name="id"
                                                                    value="{{ $data->id }}">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Simpan</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection

@section('page-js')
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/static/js/pages/simple-datatables.js"></script>
@endsection
