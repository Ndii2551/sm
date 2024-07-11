@extends('layouts.app')
@section('page-css')
    {{-- choices --}}
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/choices.js/public/assets/styles/choices.css">

    {{-- file uploader --}}
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ url_plug() }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ url_plug() }}/assets/extensions/toastify-js/src/toastify.css">
@endsection
@section('content')
    @if (Auth::user()->role_id == 5)
        @include('guest')
    @else
        <div id="main-content">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Vertical Layout with Navbar</h3>
                            <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">About Vertical Navbar</h4>
                        </div>
                        <div class="card-body">
                            <p>Vertical Navbar is a layout option that you can use with Mazer. </p>

                            <p>In case you want the navbar to be sticky on top while scrolling, add
                                <code>.navbar-fixed</code>
                                class alongside with <code>.layout-navbar</code> class.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Dummy Text</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In mollis tincidunt tempus. Duis
                                vitae
                                facilisis enim, at rutrum lacus. Nam at nisl ut ex egestas placerat sodales id quam. Aenean
                                sit
                                amet nibh quis lacus pellentesque venenatis vitae at justo. Orci varius natoque penatibus et
                                magnis dis parturient montes, nascetur ridiculus mus. Suspendisse venenatis tincidunt odio
                                ut
                                rutrum. Maecenas ut urna venenatis, dapibus tortor sed, ultrices justo. Phasellus
                                scelerisque,
                                nibh quis gravida venenatis, nibh mi lacinia est, et porta purus nisi eget nibh. Fusce
                                pretium
                                vestibulum sagittis. Donec sodales velit cursus convallis sollicitudin. Nunc vel scelerisque
                                elit, eget facilisis tellus. Donec id molestie ipsum. Nunc tincidunt tellus sed felis
                                vulputate
                                euismod.
                            </p>
                            <p>
                                Proin accumsan nec arcu sit amet volutpat. Proin non risus luctus, tempus quam quis,
                                volutpat
                                orci. Phasellus commodo arcu dui, ut convallis quam sodales maximus. Aenean sollicitudin
                                massa a
                                quam fermentum, et efficitur metus convallis. Curabitur nec laoreet ipsum, eu congue sem.
                                Nunc
                                pellentesque quis erat at gravida. Vestibulum dapibus efficitur felis, vel luctus libero
                                congue
                                eget. Donec mollis pellentesque arcu, eu commodo nunc porta sit amet. In commodo augue id
                                mauris
                                tempor, sed dignissim nulla facilisis. Ut non mattis justo, ut placerat justo. Vestibulum
                                scelerisque cursus facilisis. Suspendisse velit justo, scelerisque ac ultrices eu,
                                consectetur
                                ac odio.
                            </p>
                            <p>
                                In pharetra quam vel lobortis fermentum. Nulla vel risus ut sapien porttitor volutpat eu ac
                                lorem. Vestibulum porta elit magna, ut ultrices sem fermentum ut. Vestibulum blandit eros ut
                                imperdiet porttitor. Pellentesque tempus nunc sed augue auctor eleifend. Sed nisi sem,
                                lobortis
                                eget faucibus placerat, hendrerit vitae elit. Vestibulum elit orci, pretium vel libero at,
                                imperdiet congue lectus. Praesent rutrum id turpis non aliquam. Cras dignissim, metus vitae
                                aliquam faucibus, elit augue dignissim nulla, bibendum consectetur leo libero a tortor.
                                Vestibulum non tincidunt nibh. Ut imperdiet elit vel vehicula ultricies. Nulla maximus justo
                                sit
                                amet fringilla laoreet. Aliquam malesuada diam in augue mattis aliquam. Pellentesque id eros
                                dignissim, dapibus sem ac, molestie dolor. Mauris purus lacus, tempor sit amet vestibulum
                                vitae,
                                ultrices eu urna.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    @endif
@endsection
@section('page-js')
    {{-- choices --}}
    <script src="{{ url_plug() }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/form-element-select.js"></script>

    {{-- file uploader --}}
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js">
    </script>
    <script
        src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js">
    </script>
    <script src="{{ url_plug() }}/assets/extensions/filepond/filepond.js"></script>
    <script src="{{ url_plug() }}/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ url_plug() }}/assets/static/js/pages/filepond.js"></script>
    <script>
        FilePond.create(document.querySelector(".basic-filepond2"), {
            credits: null,
            allowImagePreview: false,
            allowMultiple: false,
            allowFileEncode: false,
            required: false,
            storeAsFile: true,
        });
    </script>

    {{-- dashboard --}}
    <script src="{{ url_plug() }}/assets/static/js/pages/dashboard.js"></script>
@endsection
