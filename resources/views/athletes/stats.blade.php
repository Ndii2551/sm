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
                        <p class="text-subtitle text-muted">Statistik</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Seleksi Atlet</li>
                                <li class="breadcrumb-item active" aria-current="page">Statistik</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Statistik Athlet
                        </h5>
                        <p>{{ $athlet->nama }} - {{ $athlet->branches->cabang }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end mb-3">
                                <img src="{{ asset('uploads/dokumen_atlet/' . $athlet->pasfoto) }}" alt=""
                                    width="100px">
                            </div>
                            <div>
                                @foreach ($types as $data)
                                    <form class="d-inline" action="{{ route('athletes.stats') }}" method="GET"
                                        class="mb-3">
                                        <input type="hidden" name="id" value="{{ $athlet->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary" name="type"
                                            value="{{ $data->nama }}">{{ $data->nama }}</button>
                                    </form>
                                @endforeach
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                @if ($type == '')
                                                    {{ $types1->nama }}
                                                @else
                                                    {{ $type }}
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="area"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
