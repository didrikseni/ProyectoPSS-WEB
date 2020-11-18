@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="justify-content-center m-5">
            <div class="col-9 my-5">
                <h1> Asociar profesor a una materia </h1>
            </div>

            <div class="col-9 my-5">
                <form method="POST" action="/materia/profesor" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="materia">Materia (*)</label>
                                <div>
                                    <input class="input-group form-control @error('materia') alert-danger @enderror"
                                           type="text" name="materia" id="materia" value="{{ old('materia') }}">
                                    @error('materia')
                                    <p class="badge badge-danger">{{ $errors->first('materia') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="profesor">Profesor (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('profesor') alert-danger @enderror"
                                        type="number" name="profesor" id="profesor"
                                        value="{{ old('profesor') }}">
                                    @error('profesor')
                                    <p class="badge badge-danger">{{ $errors->first('profesor') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="asistente">Asistente (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('asistente') alert-danger @enderror"
                                        type="number" name="asistente" id="asistente"
                                        value="{{ old('asistente') }}">
                                    @error('asistente')
                                    <p class="badge badge-danger">{{ $errors->first('asistente') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <h4 class="text-center"> (*) Campo obligatorio </h4>
                        </div>
                    </div>

                    <div class="row justify-content-center my-5">
                        <div class="form-group">
                            <div class="col-auto">
                                <button class="waves-effect waves-light btn">Aceptar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-auto">
                                <a class="waves-effect waves-light btn" href="/">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


