@extends('layouts.app')
@section('page-css')
@endsection
@section('content')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Informasi Pribadi</h3>
                        <p class="text-subtitle text-muted">Data Pengurus Cabang</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Informasi Pribadi</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pengurus Cabang</li>
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
                                Data pengurus cabang belum diisi.
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ url('branchdata/store') }}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cabang">Cabang</label>
                                                <select class="form-select" name="cabang" id="cabang">
                                                    <option value="" selected>-- Pilih Cabang --</option>
                                                    <option value="Kabupaten Serang">Kabupaten Serang</option>
                                                    <option value="Kota Serang">Kota Serang</option>
                                                    <option value="Kabupaten Pandeglang">Kabupaten Pandeglang</option>
                                                    <option value="Kabupaten Lebak">Kabupaten Lebak</option>
                                                    <option value="Kabupaten Tangerang">Kabupaten Tangerang</option>
                                                    <option value="Kota Tangerang">Kota Tangerang</option>
                                                    <option value="Kota Tangerang Selatan">Kota Tangerang Selatan</option>
                                                    <option value="Kota Cilegon">Kota Cilegon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no_sk">Nomor SK Pengurus</label>
                                                <input type="text" class="form-control" placeholder="Nomor SK Pengurus"
                                                    id="no_sk" name="no_sk">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="user_id"
                                                value="{{ Auth::user()->id }}">Simpan</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
                            <form class="form form-vertical" action="{{ url('branchdata/update') }}" method="post">
                                @csrf
                                @method('PUT')
                                @foreach ($datas as $data)
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="cabang">Cabang</label>
                                                    <select class="form-select" name="cabang" id="cabang">
                                                        <option value="Kabupaten Serang"
                                                            @if ($data->cabang == 'Kabupaten Serang') selected @endif>Kabupaten
                                                            Serang</option>
                                                        <option value="Kota Serang"
                                                            @if ($data->cabang == 'Kota Serang') selected @endif>Kota Serang
                                                        </option>
                                                        <option value="Kabupaten Pandeglang"
                                                            @if ($data->cabang == 'Kabupaten Pandeglang') selected @endif>Kabupaten
                                                            Pandeglang</option>
                                                        <option value="Kabupaten Lebak"
                                                            @if ($data->cabang == 'Kabupaten Lebak') selected @endif>Kabupaten
                                                            Lebak</option>
                                                        <option value="Kabupaten Tangerang"
                                                            @if ($data->cabang == 'Kabupaten Tangerang') selected @endif>Kabupaten
                                                            Tangerang</option>
                                                        <option value="Kota Tangerang"
                                                            @if ($data->cabang == 'Kota Tangerang') selected @endif>Kota Tangerang
                                                        </option>
                                                        <option value="Kota Tangerang Selatan"
                                                            @if ($data->cabang == 'Kota Tangerang Selatan') selected @endif>Kota Tangerang
                                                            Selatan
                                                        </option>
                                                        <option value="Kota Cilegon"
                                                            @if ($data->cabang == 'Kota Cilegon') selected @endif>Kota Cilegon
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="no_sk">Nomor SK Pengurus</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Nomor SK Pengurus" id="no_sk" name="no_sk"
                                                        value="{{ $data->no_sk }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="id"
                                                value="{{ $data->id }}">Simpan</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
@endsection
