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

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<div id="app">
    <!-- Navbar -->
    <nav class="orange lighten-3 mb-5">
        <div class="nav-wrapper">
            <a class="navbar-brand mx-3" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->user()->nombre }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <div class="nav-wrapper deep-orange accent-1">
            <ul id="nav-mobile" class="hide-on-med-and-down">
                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1" href="#" role="sbutton" id="dropdownMenuCarrera"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carrera</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuCarrera">
                            <a class="dropdown-item" href="#">Crear</a>
                            <a class="dropdown-item" href="#">Buscar</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1" href="#" role="sbutton" id="dropdownMenuMateria"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Materia</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuMateria">
                            <a class="dropdown-item" href="/materias/create">Crear</a>
                            <a class="dropdown-item" href="/busqueda/materias">Buscar</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1" href="#" role="sbutton" id="dropdownMenuUsuario"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuario">
                            <a class="dropdown-item" href="/User/create">Crear</a>
                            <a class="dropdown-item" href="/User">Buscar</a>
                        </div>
                    </div>
                </li>

                <li><a class="waves-effect waves-light btn deep-orange accent-1" href="/correlativas/create">Asociar correlativa</a></li>
                <li><a class="waves-effect waves-light btn deep-orange accent-1" href="/">Asociar materia a carrera</a></li>
                <li><a class="waves-effect waves-light btn deep-orange accent-1" href="/">Asociar profesor a materia</a></li>

            </ul>
        </div>
    </nav>
    <!-- Nabvar -->

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
