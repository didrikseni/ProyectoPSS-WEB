@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="m-5">
            <div class="col-9">
                <h1> Modificar Nota </h1>
            </div>

            <br>

            <form method="POST" action="{{ route('Nota.update', $nota->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="col-9">
                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="tipoExamen">{{ $nota->esFinal() ? 'Mesa de examen' : 'Materia' }}</label>
                                <div>
                                    <input
                                        class="disabled input-group form-control @error('tipoExamen') alert-danger @enderror"
                                        type="text" name="tipoExamen" id="tipoExamen"
                                        value="{{ $nota->esFinal() ? $nota->id_mesa_examen : $nota->id_materia }}">
                                    @error('tipoExamen')
                                    <p class="badge badge-danger">{{ $errors->first('tipoExamen') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row my-5">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="alumno">Alumno</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('alumno') alert-danger @enderror"
                                        type="text" name="alumno" id="alumno" value="{{ $nota->alumno()->legajo }}">
                                    @error('alumno')
                                    <p class="badge badge-danger">{{ $errors->first('alumno') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        @if($tipo === 'final')
                            <div class="col">
                                <div class="form-group">
                                    <label for="calificacion">Seleccione la Nota: (*)</label>
                                    <div>
                                        <select name="calificacion" id="calificacion" class="form-control">
                                            @foreach ($nota->gradingNumResult(10) as $option)
                                                <option {{ $nota->calificacionFinal == $option ? 'selected' : '' }} value="{{$option}}">{{$option}}</option>
                                            @endforeach
                                        </select>
                                        @error('calificacion')
                                        <p class="badge badge-danger">{{ $errors->first('calificacion') }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col">
                                <div class="form-group">
                                    <label for="calificacion">Seleccione la Nota: (*)</label>
                                    <div>
                                        <select name="calificacion" id="calificacion" class="form-control">
                                            @foreach ($nota->gradingResult() as $option)
                                                <option {{ $nota->calificacionCursada == $option ? 'selected' : '' }} value="{{$option}}">{{$option}}</option>
                                            @endforeach
                                        </select>
                                        @error('calificacion')
                                        <p class="badge badge-danger">{{ $errors->first('calificacion') }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

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
                                       href="/">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

@endsection



