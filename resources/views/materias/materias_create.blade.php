@extends('layouts.app')

@section('content')
    @if(session('success'))
        <h1>{{session('success')}}</h1>
    @endif

    <div class="page-content">
        <div class="m-5">
            <div class="col-9">
                <h1> Alta de materia </h1>
            </div>
            <div class="col-9">
                <h5> (*) Campo obligatorio </h5>
            </div>
            <br>
            <form method="POST" action="/materias" enctype="multipart/form-data">
                @csrf
                <div class="col-9">
                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="nombre">Nombre (*)</label>
                                <div>
                                    <input class="input-group form-control @error('nombre') alert-danger @enderror"
                                           type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                    <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="id">Identificador (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('id') alert-danger @enderror"
                                        type="text" name="id" id="id" value="{{ old('id') }}">
                                    @error('id')
                                    <p class="badge badge-danger">{{ $errors->first('id') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="dpto">Departamento responsable (*)</label>
                                <select class="form-control @error('dpto') alert-danger @enderror"
                                        type="text" name="dpto" id="dpto" value="{{ old('dpto') }}" id="dpto">
                                    @foreach($dptos as $dpto)
                                        <option value="{{ $dpto->id }}">{{ $dpto->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('dpto')
                                <p class="badge badge-danger">{{ $errors->first('dpto') }}</p>
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
                                        type="number" name="profesor" id="profesor" value="{{ old('profesor') }}">
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
                                        type="number" name="asistente" id="asistente" value="{{ old('asistente') }}">
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
                                   href="{{ '/materias/create' }}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


