@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="m-5">
            <div class="col-9">
                <h1> Modificar una carrera </h1>
            </div>
            <br>
            <form method="POST" action="{{ route('Carreras.update', $carrera->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="col-9">
                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="nombre">Nombre</label>
                                <div>
                                    <input class="input-group form-control @error('nombre') alert-danger @enderror"
                                           type="text" name="nombre" id="nombre" value="{{ $carrera->nombre }}">
                                    @error('nombre')
                                    <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="anio_inicio">Año inicio</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('anio_inicio') alert-danger @enderror"
                                        type="text" name="anio_inicio" id="anio_inicio" value="{{ $carrera->anio_inicio }}">
                                    @error('anio_inicio')
                                    <p class="badge badge-danger">{{ $errors->first('anio_inicio') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="id_str">Identificador</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('id_str') alert-danger @enderror"
                                        type="text" name="id_str" id="id_str" value="{{ $carrera->id_str }}">
                                    @error('id_str')
                                    <p class="badge badge-danger">{{ $errors->first('id_str') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="departamento">Departamento responsable</label>
                                <select class="form-control @error('departamento') alert-danger @enderror"
                                        type="text" name="departamento" id="departamento" value="{{ $carrera->departamento_responsable }}"
                                        id="departamento">
                                    @foreach($dptos as $dpto)
                                        @if ($dpto->nombre === $carrera->departamento_responsable)
                                            <option selected value="{{ $dpto->id }}">{{ $dpto->nombre }}</option>
                                        @else
                                            <option value="{{ $dpto->id }}">{{ $dpto->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('departamento')
                                <p class="badge badge-danger">{{ $errors->first('departamento') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="profesor">Profesor responsable</label>
                                <select class="form-control @error('profesor') alert-danger @enderror"
                                        type="text" name="profesor" id="profesor" value="{{ $carrera->profesor_responsable }}"
                                        id="profesor">
                                    @foreach($professors as $professor)
                                        @if ($professor->id === $carrera->profesor_responsable)
                                            <option selected value="{{ $professor->id }}">{{ $professor->nombre }}</option>
                                        @else
                                            <option value="{{ $professor->id }}">{{ $professor->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('profesor')
                                <p class="badge badge-danger">{{ $errors->first('profesor') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row justify-content-center">
                        <div class="form-group">
                            <div class="col-auto">
                                <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-auto">
                                <a class="waves-effect waves-light btn"
                                   onclick="return confirm('¿Quiere cancelar? se perderan los datos ingresados')"
                                   href="{{ route('Carreras.index') }}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


