@extends('layouts.app')

@section('content')

    <div class="content">

        <div class="row m-5 ">
            <div class="col-12">
                <div class="title m-b-md">
                    <h1>Agregar nueva Nota de Cursada</h1>
                </div>
            </div>
            <div class="col-9">
                <h5> (*) Campo obligatorio </h5>
            </div>
            </br>


            <div class="col-9">
                <form action="/Nota" method = "POST" class="py-3">

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
                                @error('materia')
                                <p class="badge badge-danger">{{ $errors->first('materia') }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-row my-3">

                        <div class="col">
                            <label for="LU_alumno">LU del alumno: (*)</label>
                            <div>
                                <input type="text" id="LU_alumno" name= "LU_alumno" class="form-control" placeholder="N° de LU" value = "{{old ('LU_alumno')}}">
                                @error('LU_alumno')
                                <p class="badge badge-danger">{{ $errors->first('LU_alumno') }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col ">
                            <label for="calificacion">Seleccione la Nota a cargar: (*)</label>
                            <div>
                                <select name="calificacion" id="calificacion" class="form-control" >
                                    <option disabled selected>Seleccionar</option>
                                    @foreach ($nota->gradingResult() as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                    @endforeach
                                </select>
                                @error('calificacion')
                                <p class="badge badge-danger">{{ $errors->first('calificacion') }}</p>
                                @enderror
                            </div>
                        </div>


                    </div>


                    <p>
                        <button type="submit" class="btn btn-primary" >
                            Registrar Nota
                        </button>

                        <a href="/Nota/create" role="button" class="btn btn-danger">
                            Cancelar
                        </a>
                    </p>

                    @csrf
                </form>

            </div>

        </div>
    </div>
@endsection
