@extends('layouts.app')

@section('content')

<div class="content">

    <div class="row m-5 ">
        <div class="col-12">
            <div class="title m-b-md">
                <h1>Agregar nueva mesa de examen</h1>
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
                        <label for="materia">Materia a crear mesa de examen: (*)</label>
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
                        <label for="tipo_examen">Tipo de examen: (*)</label>
                        <div>
                            <select name="tipo_examen" id="tipo_examen" class="form-control" >
                                <option disabled selected>Seleccionar</option>
                                @foreach ($tipo_examen as $tipo)
                                    <option value="{{$tipo}}">{{$tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo_examen')
                                <p class="badge badge-danger">{{ $errors->first('tipo_examen') }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row my-3">

                    <div class="col">
                        <label for="fecha">Fecha: (*)</label>
                        <div>
                            <input type="date" name= "fecha"  class="form-control" value = "{{old ('fecha')}}">
                            @error('fecha')
                                <p class="badge badge-danger">{{ $errors->first('fecha') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="hora">Hora: (*)</label>
                        <div>
                            <input type="time" name= "hora" value = "{{old ('hora')}}" class="form-control" placeholder="Hora">
                            @error('hora')
                                <p class="badge badge-danger">{{ $errors->first('hora') }}</p>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="form-group ">
                    <label for="observaciones">Observaciones:</label>
                    <div>
                        <textarea class="form-control" id="observaciones"  name="observaciones" rows="3"></textarea>
                        @error('observaciones')
                            <p class="badge badge-danger">{{ $errors->first('observaciones') }}</p>
                        @enderror
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-primary" >
                        Crear nueva mesa
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
