@extends('layouts.app')
@section('page-css')
    <script src="{{ url_plug() }}/assets/extensions/jquery/jquery.min.js"></script>
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Seleksi Atlet</h3>
                        <p class="text-subtitle text-muted">Kelola Seleksi</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Kelola Seleksi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                            <i class="bi bi-plus"></i> Seleksi Baru
                        </button>
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
                        @if ($selections->count() != 0)
                            @foreach ($selections as $data)
                                <form class="d-none" action="{{ url('selections/details') }}" method="get"
                                    id="{{ $data->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                </form>
                                <a href="javascript:$('#{{ $data->id }}').submit();" class="card bg-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="text-white">{{ $data->nama }}</h5>
                                            @if ($data->status == 1)
                                                <span class="badge bg-success">Dibuka</span>
                                            @else
                                                <span class="badge bg-light">Ditutup</span>
                                            @endif
                                        </div>
                                        <form action="{{ url('selections/destroy') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" name="id"
                                                value="{{ $data->id }}"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-secondary"><i class="bi bi-info-circle"></i> Belum ada seleksi yang
                                dibuat.</div>
                        @endif

                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('modal')
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Login Form </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('selections/store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="nama">Nama Seleksi: </label>
                        <div class="form-group">
                            <input id="nama" type="text" placeholder="Nama Seleksi" class="form-control"
                                name="nama">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection
