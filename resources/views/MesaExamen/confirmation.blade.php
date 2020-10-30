@extends('layouts.app')

@section('content')

<div class="content">                
    
     <div class="d-flex justify-content-center">
        
        <div class="col-9">
            <div class="row">
                <div class="title m-b-md">
                    <h1>Mesa de examen cargada exitosamente</h1>            
                </div>
            </div>
            <div class="row">
                <label for="nombre">Materia= {{$materia->nombre}}</label>
            </div>
            <div class="row">
                <label for="nombre">Fecha= {{$mesa->fecha}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Horario= {{$mesa->horario}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Tipo de Examen= {{$mesa->tipo_examen}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Observaciones= {{$mesa->observaciones}}</label>
            </div>
                            
            <p>
                <a href="/User" role="button" class="btn btn-primary">
                    Volver al menu principal                       
                </a>
            </p>
            
        </div>
    </div>
    
          
 </div>          
@endsection