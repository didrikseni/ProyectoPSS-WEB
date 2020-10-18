@extends('layouts.app')

@section('content')

<div class="content">                

     <div class="d-flex justify-content-center">
        
        <div class="col-9">
            <div class="row">
                <div class="title m-b-md">
                    <h1>Usuario creado exitosamente</h1>            
                </div>
            </div>
            <div class="row">
                <label for="nombre">Nombre= {{$user->nombre}}</label>
            </div>
            <div class="row">
                <label for="nombre">Apellido= {{$user->apellido}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">DNI= {{$user->DNI}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Rol= {{$user->rol}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Email= {{$user->email}}</label>
            </div>
                
            <div class="row">
                <label for="nombre">Legajo= {{$user->legajo}}</label>
            </div>      

            <div class="row">
                <label for="nombre">Nombre de usuario= {{$user->nombre_usuario}}</label>
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