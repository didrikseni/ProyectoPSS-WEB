@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="card justify-content-center m-5">
            <div class="card-header">
                <p class="text-center"> Ingrese los siguientes datos para dar de alta una nueva materia </p>
            </div>

            <div class="card-body ">
                <form method="POST" action="/materias" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3">
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

                        <div class="col">
                            <h4> (*) Campo obligatorio </h4>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="dpto">Departamento responsable (*)</label>
                                <select class="form-control @error('dpto') alert-danger @enderror"
                                        type="text" name="dpto" id="dpto" value="{{ old('dpto') }}" id="dpto">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                @error('dpto')
                                <p class="badge badge-danger">{{ $errors->first('dpto') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="profesor">Profesor (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('profesor') alert-danger @enderror"
                                        type="text" name="profesor" id="profesor" value="{{ old('profesor') }}">
                                    @error('profesor')
                                    <p class="badge badge-danger">{{ $errors->first('profesor') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="asistente">Asistente (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('asistente') alert-danger @enderror"
                                        type="text" name="asistente" id="asistente" value="{{ old('asistente') }}">
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
                                <button class="waves-effect waves-light btn blue">Aceptar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-auto">
                                <button class="waves-effect waves-light btn blue">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


