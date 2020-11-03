@extends('layouts.app')

@section('content')

    <div class="content">

        <div class="row m-5 ">
            <div class="col-12">
                <div class="title m-b-md">
                    <h1>Agregar nueva Nota de examen</h1>
                </div>
            </div>
            <div class="col-9">
                <h5> (*) Campo obligatorio </h5>
            </div>
            </br>


            <div class="col-9">
                <form action="/MesaExamen" method = "POST" class="py-3">

                    <div class="form-row my-3">
                        <div class="col">
                            <label for="materia">Seleccionar Materia: (*)</label>
                            <div>
                                <select name="materia" id="materia" class="form-control" >
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{$materia->id}}">{{$materia->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('nombre')
                                <p class="badge badge-danger">{{ $errors->first('materia') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col ">
                            <label for="tipo_examen">Seleccione el tipo de Nota a cargar: (*)</label>
                            <div>
                                <select name="rol" id="rol" class="form-control" >
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($nota->gradingType() as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                                @error('rol')
                                <p class="badge badge-danger">{{ $errors->first('rol') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row my-3">

                        <div class="col">
                            <label for="lu">LU del alumno: (*)</label>
                            <div>
                                <input type="text" name= "nombre" value = "{{old ('nombre')}}" class="form-control" placeholder="N° de LU">
                                @error('lu')
                                <p class="badge badge-danger">{{ $errors->first('lu') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col ">
                            <label for="tipo_examen">Seleccione la Nota a cargar: (*)</label>
                            <div>
                                <select name="rol" id="rol" class="form-control" >
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($nota->gradingResult() as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                                @error('rol')
                                <p class="badge badge-danger">{{ $errors->first('rol') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col ">
                            <label for="tipo_examen">Seleccione la Calificación: (*)</label>
                            <div>
                                <select name="rol" id="rol" class="form-control" >
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($nota->gradingNumResult(10) as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                                @error('rol')
                                <p class="badge badge-danger">{{ $errors->first('rol') }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <p>
                        <button type="submit" class="btn btn-primary" >
                            Registrar Nota
                        </button>
                        <a href="/MesaExamen/create" role="button" class="btn btn-danger">
                            Cancelar
                        </a>
                    </p>

                    @csrf
                </form>

            </div>

        </div>
    </div>
@endsection
