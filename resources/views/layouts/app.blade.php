<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAJI Banten | Seleksi Atlet</title>
    <link rel="shortcut icon" href="{{ url_plug() }}/assets/favicon/favicon.png" type="image/x-icon" />
    {{-- core css --}}
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="{{ url_plug() }}/assets/compiled/css/iconly.css">
    {{-- end core css --}}
    {{-- page css --}}
    @yield('page-css')
    {{-- end page css --}}
</head>

<body>
    {{-- core js --}}
    <script src="{{ url_plug() }}/assets/static/js/initTheme.js"></script>
    {{-- end core js --}}
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('layouts.header')
            @yield('content')
            @yield('modal')
            @include('layouts.footer')
        </div>
    </div>
    {{-- core js --}}
    <script src="{{ url_plug() }}/assets/static/js/components/dark.js"></script>
    <script src="{{ url_plug() }}/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url_plug() }}/assets/compiled/js/app.js"></script>
    {{-- end core js --}}
    {{-- page js --}}
    @yield('page-js')
    {{-- end page js --}}
</body>

</html>
