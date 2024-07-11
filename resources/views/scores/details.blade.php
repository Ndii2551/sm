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
                        <p class="text-subtitle text-muted">Input Hasil Tes</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Input Hasil Tes</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Penilaian
                            @foreach ($tests as $data)
                                {{ $data->selection_regists->nama }}
                            @endforeach
                        </h5>
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
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('scores.details') }}" method="GET" class="mb-3">
                                    <div class="d-flex">
                                        <input type="hidden" name="id" value="{{ $test_id }}">
                                        <select class="form-select" name="athlet" id=""
                                            onchange="this.form.submit()">
                                            <option value="0">-- Pilih atlet peserta --</option>
                                            @foreach ($person as $data)
                                                <option value="{{ $data->athlet_id }}"
                                                    @if ($data->athlet_id == $athlet) selected @endif>
                                                    {{ $data->athletes->nama }} -
                                                    {{ $data->branches->cabang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                            @if ($athlet == '0')
                                <div class="ps-3 pe-3">
                                    <div class="alert alert-info">
                                        <strong>Perhatian!</strong>
                                        Silahkan pilih atlet terlebih dahulu
                                    </div>
                                </div>
                            @else
                                @if ($scores->count() == 0)
                                    <form action="{{ url('scores/details/store') }}" method="post">
                                        @csrf
                                        @foreach ($types as $data)
                                            <div class="col-3">{{ $data->nama }}</div>
                                            <div class="col-9 d-flex">
                                                @for ($i = 1; $i <= $data->x; $i++)
                                                    <input class="col-1 me-3" type="number"
                                                        name="{{ $loop->iteration }}_{{ $i }}" value="0"
                                                        min="0">
                                                @endfor
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="athlet_id" value="{{ $athlet }}">
                                        <button class="d-none" type="submit" name="test_id"
                                            value="{{ $test_id }}"></button>
                                    </form>
                                @else
                                    <div>
                                        @foreach ($types as $data)
                                            <div class="col-3">{{ $data->nama }}</div>
                                            <div class="col-9 d-flex">
                                                @foreach ($scores as $score)
                                                    @if ($score->nama == $data->nama)
                                                        <form class="col-1 me-3"
                                                            action="{{ url('scores/details/update') }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input class="col-12" type="number" name="nilai"
                                                                value="{{ $score->nilai }}" min="0">
                                                            <button class="d-none" type="submit" name="id"
                                                                value="{{ $score->id }}"></button>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
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
