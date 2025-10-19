<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: #FFE28A; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light border-bottom border-2 w-100" style="background-color: #FFBF00; --bs-border-color: #FFD65C;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Perpustakaan
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link link-dark link-underline-opacity-0 link-underline-opacity-100-hover" href="{{route('buku.index')}}"><i class="bi bi-bookshelf me-2"></i>Daftar Buku</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link link-dark link-underline-opacity-0 link-underline-opacity-100-hover" href="pinjaman">
                                Daftar Pinjaman buku
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark link-underline-opacity-0 link-underline-opacity-100-hover" href="/riwayatPeminjaman">
                                Riwayat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark link-underline-opacity-0 link-underline-opacity-100-hover" href="/dashboard">
                                Admin
                            </a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile')}}"><i class="bi bi-person-circle me-2"></i>Profil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"

                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-left me-1"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>