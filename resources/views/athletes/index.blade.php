@extends('layouts.app')
@section('page-css')
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable.css">
    <script src="{{ url_plug() }}/assets/extensions/jquery/jquery.min.js"></script>
    <style>
        .stats-link {
            color: #607080;
        }

        .stats-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Kelola Data</h3>
                        <p class="text-subtitle text-muted">Atlet</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kelola Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Pelatih</li>
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
                                    <th>Tempat Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor HP</th>
                                    <th>Alamat</th>
                                    <th>Cabang</th>
                                    <th>Berkas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($athletes as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <form class="d-none" id="{{ $data->id }}"
                                                action="{{ route('athletes.stats') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="type" value="">
                                                <button class="btn" type="submit">{{ $data->nama }}</button>
                                            </form>
                                            <a class="stats-link"
                                                href="javascript:$('#{{ $data->id }}').submit();">{{ $data->nama }}</a>
                                        </td>
                                        <td>{{ $data->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($data->tgl_lahir)->format('j F Y') }}
                                        </td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>{{ $data->no_hp }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->branches->cabang }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary block"
                                                data-bs-toggle="modal" data-bs-target="#{{ $data->id }}">
                                                Lihat Berkas
                                            </button>
                                            <div class="modal fade text-left" id="{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                                                            <button type="button" class="close rounded-pill"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <a
                                                                        href="{{ asset('uploads/dokumen_atlet/' . $data->pasfoto) }}"><i
                                                                            class="bi bi-file-earmark"></i>
                                                                        Pas foto</a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <a
                                                                        href="{{ asset('uploads/dokumen_atlet/' . $data->f_akta) }}"><i
                                                                            class="bi bi-file-earmark"></i>
                                                                        Akta kelahiran</a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <a
                                                                        href="{{ asset('uploads/dokumen_atlet/' . $data->f_kk) }}"><i
                                                                            class="bi bi-file-earmark"></i>
                                                                        Kartu keluarga</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Tutup</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($data->status == 3)
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif ($data->status == 4)
                                                <span class="badge bg-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->status == 3)
                                                <form class="d-inline" action="{{ url('athletes/status') }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="4">
                                                    <button class="btn icon btn-sm btn-danger" type="submit" name="id"
                                                        value="{{ $data->id }}"
                                                        onclick="return confirm('Apakah anda ingin menonaktifkannya?')"><i
                                                            class="bi bi-x"></i></button>
                                                </form>
                                            @elseif ($data->status == 4)
                                                <form class="d-inline" action="{{ url('athletes/status') }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="3">
                                                    <button class="btn icon btn-sm btn-success" type="submit"
                                                        name="id" value="{{ $data->id }}"><i
                                                            class="bi bi-check"></i></button>
                                                </form>
                                            @endif
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
