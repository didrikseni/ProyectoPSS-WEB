<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Universidad del Valle') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet"
          href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
          integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
            integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
            integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
            crossorigin="anonymous"></script>

    @yield('style')
</head>
<body>
<div id="app">
    <!-- Navbar -->
    <nav class="nav nav-pills nav-justified">
        <a class="navbar-brand mx-3" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <ul id="nav nav-tabs" class="right hide-on-med-and-down">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-raised" href="#"
                       role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ auth()->user()->nombre }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

        @if(auth()->check())
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <div class="nav-item dropdown show">
                        <a class="btn btn-raised dropdown-toggle" href="#" role="sbutton" id="dropdownMenuCarrera"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carrera</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuCarrera">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/Carreras/create">Crear</a>
                                <a class="dropdown-item" href="/">Asociar materia</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/Carreras">Buscar</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="dropdown show">
                        <a class="btn btn-raised dropdown-toggle deep-orange accent-1" href="#" role="sbutton"
                           id="dropdownMenuMateria"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Materia</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuMateria">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/materias/create">Crear</a>
                                <a class="dropdown-item" href="/correlativas/create">Asociar correlativa</a>
                                <a class="dropdown-item" href="/">Asociar profesor</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/busqueda/materias">Buscar</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="dropdown show">
                        <a class="btn btn-raised dropdown-toggle deep-orange accent-1" href="#" role="sbutton"
                           id="dropdownMenuUsuario"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuario">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/User/create">Crear</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/User">Buscar</a>
                        </div>
                    </div>
                </li>
            </ul>
        @endif
    </nav>
    <!-- Nabvar -->

    <main class="py-4">
        @yield('content')
        @yield('scripts')
    </main>
</div>
</body>
</html>
