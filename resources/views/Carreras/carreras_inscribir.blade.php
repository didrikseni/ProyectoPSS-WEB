@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="m-5">
            <div class="col-9">
                <h1> Inscribir alumno a carrera </h1>
            </div>
            <br>
            <form method="POST" action="{{ route('inscripcion_carrera.store') }}">
                @csrf
                <div class="col-9">
                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label for="carrera">Carrera</label>
                                <select class="form-control @error('carrera') alert-danger @enderror"
                                        type="text" name="carrera" id="carrera" value="{{ old('carrera') }}"
                                        id="carrera">
                                    <option selected disabled>Seleccione una carrera</option>
                                    @foreach($carreras as $carrera)
{{--                                        {{ (old("carrera") == null ? "selected":"") }}--}}
                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('carrera')
                                <p class="badge badge-danger">{{ $errors->first('carrera') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="alumno">LU de alumno (*)</label>
                                <div>
                                    <input class="input-group form-control @error('alumno') alert-danger @enderror"
                                           type="number" name="alumno" id="alumno" value="{{ old('alumno') }}">
                                    @error('alumno')
                                    <p class="badge badge-danger">{{ $errors->first('alumno') }}</p>
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
