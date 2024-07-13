<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    @if (Auth::user()->role_id == 1)
                                        Administrator
                                    @elseif (Auth::user()->role_id == 2)
                                        Pengurus Cabang
                                    @elseif (Auth::user()->role_id == 3)
                                        Pelatih
                                    @elseif (Auth::user()->role_id == 4)
                                        Atlet
                                    @elseif (Auth::user()->role_id == 5)
                                        Guest
                                    @else
                                        Undefined
                                    @endif
                                </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ url_plug() }}/assets/compiled/jpg/1.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                    class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form class="dropdown-item p-0 m-0" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
