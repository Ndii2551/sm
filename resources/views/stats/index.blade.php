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
                        <h3>Seleksi Atlet</h3>
                        <p class="text-subtitle text-muted">Tes Fisik</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Tes Fisik</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        @if ($tests->count() != 0)
                            @foreach ($tests as $data)
                                <form class="d-none" action="{{ url('stats/details') }}" method="get"
                                    id="{{ $data->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="athlet" value="0">
                                    <input type="hidden" name="type" value="0">
                                </form>
                                <a href="javascript:$('#{{ $data->id }}').submit();" class="card bg-secondary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="text-white">{{ $data->selection_regists->nama }}</h5>
                                            @if ($data->status == 1)
                                                <span class="badge bg-success">Dibuka</span>
                                            @else
                                                <span class="badge bg-light">Ditutup</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-secondary"><i class="bi bi-info-circle"></i> Anda belum ditugaskan
                                sebagai pelatih dalam seleksi
                                apapun.</div>
                        @endif

                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('modal')
@endsection

@section('page-js')
@endsection
