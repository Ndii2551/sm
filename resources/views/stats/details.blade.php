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
                        <p class="text-subtitle text-muted">Statistik Peserta</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Statistik Peserta</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            @foreach ($tests as $data)
                                {{ $data->selection_regists->nama }}
                            @endforeach
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('stats.details') }}" method="GET" class="mb-3">
                                    <div class="d-flex">
                                        <input type="hidden" name="id" value="{{ $test_id }}">
                                        <input type="hidden" name="type" value="{{ $types1->nama }}">
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
                                <div>
                                    @foreach ($types as $data)
                                        <form class="d-inline" action="{{ route('stats.details') }}" method="GET"
                                            class="mb-3">
                                            <input type="hidden" name="id" value="{{ $test_id }}">
                                            <input type="hidden" name="athlet" value="{{ $athlet }}">
                                            <button type="submit" class="btn btn-sm btn-primary" name="type"
                                                value="{{ $data->nama }}">{{ $data->nama }}</button>
                                        </form>
                                    @endforeach
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>{{ $type }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="area"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{ url_plug() }}/assets/extensions/dayjs/dayjs.min.js"></script>
    <script src="{{ url_plug() }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script>
        var areaOptions = {
            series: [{
                name: "",
                data: [
                    0,
                    @foreach ($scores as $data)
                        {{ $data->nilai }},
                    @endforeach
                ],
            }, ],
            chart: {
                height: 350,
                type: "area",
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "text",
                categories: [
                    0,
                    @foreach ($scores as $data)
                        {{ $loop->iteration }},
                    @endforeach
                ],
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
        }
        var area = new ApexCharts(document.querySelector("#area"), areaOptions)

        area.render()
    </script>
@endsection
