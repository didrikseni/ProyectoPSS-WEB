@extends('layouts.app')

@section('content')
    @if(session('success'))
        <h1>{{session('success')}}</h1>
    @endif

    <div class="page-content">
        <div class="m-5">
            <div class="col-9">
                <h1> Modificar una materia </h1>
            </div>
            <br>
            <form method="POST" action="{{ route('materias.update', $materia->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="col-9">
                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="nombre">Nombre</label>
                                <div>
                                    <input class="input-group form-control @error('nombre') alert-danger @enderror"
                                           type="text" name="nombre" id="nombre" value="{{ $materia->nombre }}">
                                    @error('nombre')
                                    <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="id_str">Identificador</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('id_str') alert-danger @enderror"
                                        type="text" name="id_str" id="id_str" value="{{ $materia->id_str }}">
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
                                        type="text" name="departamento" id="departamento" value="{{ $materia->departamento }}"
                                        id="departamento">
                                    @foreach($dptos as $dpto)
                                        @if ($dpto->id == $materia->departamento)
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
                                <label class="label" for="profesor">Profesor</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('profesor') alert-danger @enderror"
                                        type="number" name="profesor" id="profesor" value="{{ $materia->id_profesor }}">
                                    @error('profesor')
                                    <p class="badge badge-danger">{{ $errors->first('profesor') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="asistente">Asistente</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('asistente') alert-danger @enderror"
                                        type="number" name="asistente" id="asistente"
                                        value="{{ $materia->id_asistente }}">
                                    @error('asistente')
                                    <p class="badge badge-danger">{{ $errors->first('asistente') }}</p>
                                    @enderror
                                </div>
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
                                   href="{{ route('materias.store') }}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


