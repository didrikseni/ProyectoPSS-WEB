@extends('layouts.app')

@section('content')

<div class="content">                

    <div class="row m-5 ">
        <div class="col-9">
            <div class="title m-b-md">
                <h1>Agregar nueva carrera</h1>                   
            </div>
        </div>
        <div class="col-9">
            <h5> (*) Campo obligatorio </h5>
        </div>
        </br>
        
       
        
        <div class="col-9">
            <form action="/Carreras" method = "POST" class="py-3">
                
                <div class="form-row my-3">
                    <div class="col">
                        <label for="nombre">Nombre: (*)</label>
                        <div>
                            <input type="text" name= "nombre" value = "{{old ('nombre')}}" class="form-control" placeholder="Nombre">
                            @error('nombre')
                                <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="anio_inicio">Año inicio: (*)</label>
                        <div>
                            <input type="number" name= "anio_inicio" value = "{{old ('anio_inicio')}}" class="form-control" placeholder="Año inicio">
                            @error('anio_inicio')
                                <p class="badge badge-danger">{{ $errors->first('anio_inicio') }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-row my-4">
                    <div class="col" >
                        <label for="id_str">Identificador: (*)</label>
                        <div>
                            <input type="text" name= "id_str" value = "{{old ('id_str')}}" class="form-control" placeholder="Identificador">
                            @error('id_str')
                                <p class="badge badge-danger">{{ $errors->first('id_str') }}</p>
                            @enderror
                        </div>
                    </div>       
                </div>


                <div class="form-group">
                    <label for="departamento_responsable">Departamento responsable: (*)</label>
                    <div>
                        <select name="departamento_responsable" id="departamento_responsable" class="form-control" >
                            <option disabled selected>Seleccionar</option>
                            @foreach ($departamentos as $departamento)                            
                                <option value="{{$departamento->id}}">{{$departamento->nombre }}</option>
                            @endforeach                                                      
                        </select>
                        @error('nombre')
                            <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="profesor_responsable">Profesor responsable: (*)</label>
                    <div>
                        <select name="profesor_responsable" id="profesor_responsable" class="form-control" >
                            <option disabled selected>Seleccionar</option>
                            @foreach ($professors as $professor)                            
                                <option value="{{$professor->id}}">{{$professor->nombre .' '. $professor->apellido}}</option>
                            @endforeach                                                      
                        </select>
                        @error('nombre')
                            <p class="badge badge-danger">{{ $errors->first('nombre') }}</p>
                        @enderror
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-primary" >
                        Crear nueva carrera
                    </button>
                    <a href="/Carreras/create" role="button" class="btn btn-danger">
                        Cancelar                       
                    </a>
                </p> 
                
                @csrf
            </form>

        </div>
    
    </div>                  
 </div>          
@endsection