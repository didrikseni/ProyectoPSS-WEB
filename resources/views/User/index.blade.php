@extends('layouts/app')

@section('content')

<div class="content">                
       
    <div class="col-12">
        <div class="title m-b-md">
            <h1>Usuarios</h1>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Legajo</th>                       
                        <th scope="col">Número de telefono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->nombre}}</th>
                            <th>{{$user->apellido}} </th>
                            <th>{{$user->nombre_usuario}} </th> 
                            <th>{{$user->DNI}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->fecha_nacimiento}}</th> 
                            <th>{{$user->legajo}}</th>
                            <th>{{$user->numero_telefono}}</th> 
                            
                        </tr>                            
                    @endforeach                         
                </tbody>
            </table>
        </div>        
    </div>
              
                              
 </div>          
@endsection