@extends('layouts.app')

@section('content')

<div class="content">                

        <div class="row mx-3 my-2 ">
            <div class="col-9">
                <div class="title m-b-md">
                    <h1>Agregar nueva carrera.</h1>
                   
                </div>
            </div>
        </div>
       
        <div class="col-12">
            <div class="col-9">
                <form action="/materias" method = "POST" class="py-3">
                   
                    <div class="form-row my-3">
                        <div class="col">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name= "nombre" value = "{{old ('nombre')}}" class="form-control" placeholder="Nombre">
                            <div>{{$errors->first('nombre')}}</div>
                        </div>

                        <div class="col">
                            <label for="anio_inicio">Año inicio:</label>
                            <input type="number" name= "anio_inicio" value = "{{old ('anio_inicio')}}" class="form-control" placeholder="Año inicio">
                            <div>{{$errors->first('anio_inicio')}}</div>
                        </div>
                    </div>

                   
                    <div class="form-row my-4">
                        <div class="col" >
                            <label for="id_str">Identificador:</label>
                            <input type="text" name= "id_str" value = "{{old ('id_str')}}" class="form-control" placeholder="Identificador">
                            <div>{{$errors->first('id_str')}}</div>
                        </div> 
                        <div class="col ">
                            <label for="departemento_responsable">Departamento Responsable:</label>
                            <input type="text" name= "departemento_responsable" value = "{{old ('departemento_responsable')}}" class="form-control" placeholder="Departemento Responsable">
                            <div>{{$errors->first('departemento_responsable')}}</div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="rol">Profesor responsable:</label>
                        <select name="rol" id="rol" class="form-control" >
                            <option disabled selected>Seleccionar</option>
                            @foreach ($professors as $professor)                            
                                <option value="{{$professor}}">{{$professor->nombre .' '. $professor->apellido}}</option>
                            @endforeach                                                      
                        </select>
                        <div>{{$errors->first('professor')}}</div>
                    </div>

                    <p>
                        <button type="submit" class="btn btn-primary" >
                            Crear nuevo usuario
                        </button>
                        <a href="/User/create" role="button" class="btn btn-danger">
                            Cancelar                       
                        </a>
                    </p> 
                   
                    @csrf
                </form>

            </div>
        </div>
                              
 </div>          
@endsection