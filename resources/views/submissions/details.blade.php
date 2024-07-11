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
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible show fade mt-3">
                                <strong>Berhasil!</strong>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible show fade mt-3">
                                <strong>Perhatian!</strong>
                                {{ session('error') }}
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($athletes as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>
                                            @php
                                                $birthdate = $data->tgl_lahir;
                                                $age = \Carbon\Carbon::parse($birthdate)->age;
                                            @endphp
                                            {{ $age }} Tahun
                                        </td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>
                                            <form action="{{ url('submissions/details/add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="selection_id" value="{{ $selection_id }}">
                                                <button class="btn icon btn-sm btn-primary" type="submit" name="athlet_id"
                                                    value="{{ $data->id }}"><i class="bi bi-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Daftar atlet yang diajukan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Aksi</th>
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
                </div>
            </section>
        </div>

    </div>
@endsection

@section('modal')
@endsection

@section('page-js')
    <script src="{{ url_plug() }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/simple-datatables.js"></script>
@endsection
