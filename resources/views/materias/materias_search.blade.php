@extends('layouts.app')


@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Materias</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">ID</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Asistente</th>
                        <th scope="col">Correlativas debiles</th>
                        <th scope="col">Correlativas fuertes</th>
                        <th scope="col">Año de la carrera</th>
                        <th scope="col">Cuatrimestre</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($materias as $materia)
                        <tr>
                            <th>{{$materia->nombre}}</th>
                            <th>{{$materia->id_str}} </th>
                            <th scope="col">{{App\Models\Departamentos::where('id', '=', $materia->departamento)->first()->nombre}}</th>
                            <th scope="col">{{App\Models\User::where('id', '=', $materia->id_profesor)->first()->nombre}}</th>
                            <th scope="col">{{App\Models\User::where('id', '=', $materia->id_asistente)->first()->nombre}}</th>
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="justify-content-center m-5">
            <div class="col-9">
                <form method="POST" action="/materias/search" enctype="multipart/form-data">
                    @csrf

                    <input class="invisible disabled" value="" name="carrera" id="carrera"/>
                    <input class="invisible disabled" value="" name="materia" id="materia"/>

                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="cform">Seleccione la carrera</label>
                                <select class="form-control @error('cform') alert-danger @enderror"
                                        type="text" name="cform" id="cform" value="{{ old('cform') }}"
                                        id="cform" onselect="selectCarrera(this)">
                                    @foreach($carreras as $carrera)
                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('cform')
                                <p class="badge badge-danger">{{ $errors->first('cform') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="cformid">O ingrese el identificador de la carrera</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('cformid') alert-danger @enderror"
                                        type="text" name="cformid" id="carreraid" value="{{ old('cformid') }}"
                                        onchange="selectCarrera(this)">
                                    @error('cformid')
                                    <p class="badge badge-danger">{{ $errors->first('cformid') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3 disabled" id="materias_div">
                        <div class="col">
                            <div class="form-group">
                                <label for="mform">Seleccione la materia</label>
                                <select class="form-control @error('mform') alert-danger @enderror"
                                        type="text" name="mform" id="mform" value="{{ old('mform') }}" id="mform"
                                        onselect="selectMateria(this)">
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('mform')
                                <p class="badge badge-danger">{{ $errors->first('mform') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="mformid">O ingrese el identificador de la materia</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('mformid') alert-danger @enderror"
                                        type="text" name="mformid" id="mformid" value="{{ old('mformid') }}"
                                        onchange="selectMateria(this)">
                                    @error('mformid')
                                    <p class="badge badge-danger">{{ $errors->first('mformid') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row justify-content-center">
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="waves-effect waves-light btn">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>

                @if($matInfo !== null)
                    <br>
                    <div class="m-5">
                        <h4>Información</h4>
                        <div class="col">
                            <p class="text-xl-left">Nombre: {{ $matInfo->nombre }}</p>
                            <hr>
                            <p class="text-xl-left">Identificador: {{ $matInfo->id_str }}</p>
                            <hr>
                            <p class="text-xl-left">Departamento responsable: {{ $matInfo->departamento }}</p>
                            <hr>
                            <p class="text-xl-left">Profesor: {{ $matInfo->profesor }}</p>
                            <hr>
                            <p class="text-xl-left">Asistente: {{ $matInfo->asistente }}</p>
                            <hr>
                            <p class="text-xl-left">Correlativas debiles: {{ $matInfo->correlatDebiles }}</p>
                            <hr>
                            <p class="text-xl-left">Correlativas fuertes: {{ $matInfo->correlatFuertes }}</p>
                            <hr>
                            <p class="text-xl-left">Año de la carrera: {{ $matInfo->anio }}</p>
                            <hr>
                            <p class="text-xl-left">Cuatrimestre: {{ $matInfo->cuatrimestre }}</p>
                            <hr>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/MateriasSearch.js') }}"></script>

