<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- Navbar -->
<nav class="orange lighten-3 mb-5">
    <div class="nav-wrapper">
        <a class="navbar-brand mx-3 custom-text-navbar" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link custom-text-navbar" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                @if (auth()->user()->isStudent() && auth()->user()->carrera()->first() != null)
                    <li class="nav-item">
                        <a class="custom-text-navbar"> {{ auth()->user()->carrera()->first()->nombre }}</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle custom-text-navbar" href="#" role="button"
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

    @if(auth()->check())
        <div class="nav-wrapper deep-orange accent-1">
            <ul id="nav-mobile" class="hide-on-med-and-down">
                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1 custom-text-navbar" href="#" role="sbutton"
                           id="dropdownMenuCarrera"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carrera</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuCarrera">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/Carreras/create">Crear</a>
                                <a class="dropdown-item" href="{{ route('carreras_materias.create') }}">Asociar
                                    materia</a>
                                <a class="dropdown-item" href="{{ route('inscripcion_carrera.create') }}">Inscribir a
                                    carrera</a>
                            @endif
                            <a class="dropdown-item" href="/Carreras">Buscar</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1 custom-text-navbar" href="#" role="sbutton"
                           id="dropdownMenuMateria"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Materia</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuMateria">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/materias/create">Crear</a>
                                <a class="dropdown-item" href="/correlativas/create">Asociar correlativa</a>
                                <a class="dropdown-item" href="/materia/profesor">Asociar profesor</a>
                            @endif
                            @if(auth()->user()->isStudent())
                                <a class="dropdown-item" href="{{ route('inscripcion_materia.create') }}">Inscribir a
                                    materia</a>
                            @endif
                            <a class="dropdown-item" href="/materias">Buscar</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1 custom-text-navbar" href="#" role="sbutton"
                           id="dropdownMenuUsuario"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuario">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/User/create">Crear</a>
                            @else
                                <a class="dropdown-item" href="/User/{{ auth()->user()->id }}/edit">Editar información</a>
                            @endif
                            <a class="dropdown-item" href="/User">Buscar</a>

                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1 custom-text-navbar" href="#" role="sbutton"
                           id="dropdownMenuUsuario"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notas</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuario">
                            @if(auth()->user()->isProfessor())
                                <a class="dropdown-item" href="/Nota/create">Cargar Nota Cursada</a>
                                <a class="dropdown-item" href="/final/nota/create">Cargar Nota Final</a>
                            @endif
                            <a class="dropdown-item" href="/Nota">Buscar</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle deep-orange accent-1 custom-text-navbar" href="#" role="sbutton"
                           id="dropdownMenuUsuario"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mesas de Examen</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUsuario">
                            @if(auth()->user()->isAdmin())
                                <a class="dropdown-item" href="/MesaExamen/create">Crear</a>
                            @endif
                            <a class="dropdown-item" href="/MesaExamen">Buscar</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    @endif
</nav>
<!-- Nabvar -->
