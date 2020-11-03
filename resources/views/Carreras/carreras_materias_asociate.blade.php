@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="justify-content-center m-5">
            <div class="col-9 my-5">
                <h1> Asociar materia a una carrera </h1>
            </div>
            <div class="col-9">
                <h5> (*) Campo obligatorio </h5>
            </div>
            </br>

            <div class="col-9 my-5">
                <form method="POST" action="/carreras_materias" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="carrera">Carrera (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('carrera') alert-danger @enderror"
                                        type="text" name="carrera" id="carrera"
                                        value="{{ old('carrera') }}">
                                    @error('carrera')
                                    <p class="badge badge-danger">{{ $errors->first('carrera') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

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

                    <br>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="anio">Año de carrera (*)</label>
                                <input class="input-group form-control @error('anio') alert-danger @enderror"
                                       type="number" name="anio" id="anio" value="{{ old('anio') }}">
                                @error('anio')
                                <p class="badge badge-danger">{{ $errors->first('anio') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cuatrimestre">Cuatrimestre (*)</label>
                                <select class="form-control @error('cuatrimestre') alert-danger @enderror"
                                        type="text" name="cuatrimestre" id="cuatrimestre" value="{{ old('cuatrimestre') }}">
                                    <option disabled selected>Seleccionar</option>
                                    <option value="0">Primer</option>
                                    <option value="1">Segundo</option>
                                </select>
                                @error('cuatrimestre')
                                <p class="badge badge-danger">{{ $errors->first('cuatrimestre') }}</p>
                                @enderror
                            </div>
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
                                <button class="waves-effect waves-light btn">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
