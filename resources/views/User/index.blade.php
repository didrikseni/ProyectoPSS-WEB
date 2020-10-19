@extends('layouts/app')

@section('content')

<div class="content">                
       
    <div class="col-12">
        <div class="title m-b-md">
            <h1>Usuarios</h1>
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">LU</th>
                        <th scope="col"> Rol </th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">Usuario</th>
                            <th scope="col">DNI</th>
                        @endif
                        <th scope="col">Email</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Direccion</th>                       
                            <th scope="col">Número de telefono</th>
                            <th scope="col">Escuela Secundaria</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->nombre}}</th>
                            <th>{{$user->apellido}} </th>
                            <th>{{$user->legajo}} </th>
                            <th>{{$user->rol}} </th>
                            @if(auth()->user()->isAdmin())
                                <th>{{$user->nombre_usuario}} </th> 
                                <th>{{$user->DNI}}</th>
                            @endif                            
                            <th>{{$user->email}}</th>
                            @if(auth()->user()->isAdmin())
                                <th>{{$user->fecha_nacimiento}}</th> 
                                <th>{{$user->direccion_calle . ' '. $user->direccion_numero}}</th>
                                <th>{{$user->numero_telefono}}</th> 
                                <th>{{$user->escuela_secundaria}}</th> 
                            @endif
                            
                        </tr>                            
                    @endforeach                         
                </tbody>
            </table>
        </div>        
    </div>
              
                              
 </div>          
@endsection