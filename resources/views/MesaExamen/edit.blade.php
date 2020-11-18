@extends('layouts.app')

@section('content')

<div class="content">

    <div class="row m-5 ">
        <div class="col-12">
            <div class="title m-b-md">
                <h1>Modificar mesa de examen</h1>
            </div>
        </div>

        <div class="col-9">
            <form action="{{ route('MesaExamen.update', $mesa->id) }}" method = "POST" class="py-3">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-row my-5">

                    <div class="col">
                        <label for="fecha">Fecha: (*)</label>
                        <div>
                            <input type="date" name= "fecha"  class="form-control" value ="{{$mesa->fecha}}">
                            @error('fecha')
                                <p class="badge badge-danger">{{ $errors->first('fecha') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="hora">Hora: (*)</label>
                        <div>
                            <input type="time" name= "hora" value="{{ $mesa->hora }}" class="form-control" >
                            @error('hora')
                                <p class="badge badge-danger">{{ $errors->first('hora') }}</p>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="form-group">
                    <label for="observaciones">Observaciones:</label>
                    <div>
                        <textarea class="form-control" id="observaciones"  name="observaciones" rows="3">{{$mesa->observaciones}}</textarea>
                        @error('observaciones')
                            <p class="badge badge-danger">{{ $errors->first('observaciones') }}</p>
                        @enderror
                    </div>
                </div>

                <br>
                <div class="row justify-content-center my-5">
                    <div class="form-group">
                        <div class="col-auto">
                            <button type="submit" class="waves-effect waves-light btn">Aceptar</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-auto">
                            <a class="waves-effect waves-light btn"
                                onclick="return confirm('¿Quiere cancelar? se perderan los datos ingresados')"
                                href="{{ route('MesaExamen.store') }}">Cancelar</a>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
 </div>
@endsection
