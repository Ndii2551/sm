@extends('layouts.app')
@section('page-css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Lainnya</h3>
                        <p class="text-subtitle text-muted">
                            @if (Auth::user()->role_id == 1)
                                Kelola
                            @endif Pengumuman
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lainnya</li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @if (Auth::user()->role_id == 1)
                                        Kelola
                                    @endif Pengumuman
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        @if (Auth::user()->role_id == 1)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                                <i class="bi bi-megaphone"></i> Publish Pengumuman
                            </button>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade mt-3">
                                    <strong>Berhasil!</strong>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($datas->count() != 0)
                            @foreach ($datas as $data)
                                <a href="{{ asset('uploads/pengumuman/' . $data->file) }}" class="card bg-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="text-white">{{ $data->judul }}</h5>
                                            <span class="badge bg-primary">{{ $data->created_at }}</span>
                                        </div>
                                        @if (Auth::user()->role_id == 1)
                                            <form action="{{ url('announcements/destroy') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" name="id"
                                                    value="{{ $data->id }}"><i class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-secondary"><i class="bi bi-info-circle"></i> Belum ada pengumuman yang
                                dipublish.</div>
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
                <form action="{{ url('announcements/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="judul">Judul Pengumuman: </label>
                        <div class="form-group">
                            <input id="judul" type="text" placeholder="Judul Pengumuman" class="form-control"
                                name="judul">
                        </div>
                        <label for="file">Upload PDF: </label>
                        <div class="form-group">
                            <input id="file" type="file" accept=".pdf" class="form-control" name="file">
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
