@extends('layouts.app')


@section('content')
    @if(auth()->check())
        <div class="page-content">
            <div class="card justify-content-center m-5">
                <div class="card-body ">
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
                                            type="text" name="mformid" id="mformid" value="{{ old('mformid') }}" onchange="selectMateria(this)">
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
                        <div class="m-5 card">
                            <h4 class="card-header">Información</h4>
                            <div class="card-body">
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
    @endif
@endsection

<script src="{{ asset('js/MateriasSearch.js') }}"></script>

