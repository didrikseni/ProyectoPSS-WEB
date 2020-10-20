@extends('layouts.app')

@section('content')

<div class="content">

        <div class="row mx-3 my-2 ">
            <div class="col-9">
                <div class="title m-b-md">
                    <h1>Agregar nuevo usuario.</h1>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="col-9">
                <form action="/User" method = "POST" class="py-3">

                    <div class="form-row my-3">
                        <div class="col">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name= "nombre" value = "{{old ('nombre')}}" class="form-control" placeholder="Nombre">
                            <div>{{$errors->first('nombre')}}</div>
                        </div>

                        <div class="col">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name= "apellido" value = "{{old ('apellido')}}" class="form-control" placeholder="Apellido">
                            <div>{{$errors->first('apellido')}}</div>
                        </div>
                    </div>


                    <div class="form-row my-4">
                        <div class="col">
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" name= "fecha_nacimiento"  class="form-control" value = "{{old ('fecha_nacimiento')}}">
                            <div>{{$errors->first('fecha_nacimiento')}}</div>
                        </div>

                        <div class="col">
                            <label for="lugar_nacimiento">Lugar de nacimiento:</label>
                            <input type="text" name= "lugar_nacimiento" value = "{{old ('lugar_nacimiento')}}" class="form-control" placeholder="Lugar de nacimiento">
                            <div>{{$errors->first('lugar_nacimiento')}}</div>
                        </div>
                    </div>

                    <div class="form-row my-4">
                        <div class="col" >
                            <label for="DNI">DNI:</label>
                            <input type="number" name= "DNI" value = "{{old ('DNI')}}" class="form-control" placeholder="DNI">
                            <div>{{$errors->first('DNI')}}</div>
                        </div>
                        <div class="col ">
                            <label for="numero_telefono">Número de telfono:</label>
                            <input type="text" name= "numero_telefono" value = "{{old ('numero_telefono')}}" class="form-control" placeholder="Número de telefono">
                            <div>{{$errors->first('numero_telefono')}}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion_calle">Dirección:</label>
                        <div class="form-row ">
                            <div class="col">
                                <input type="text" name= "direccion_calle" value = "{{old ('direccion_calle')}}" placeholder="Calle" class="form-control">
                                <div>{{$errors->first('direccion_calle')}}</div>
                            </div>
                            <div class="col">
                                <input type="number" name= "direccion_numero" value = "{{old ('direccion_numero')}}" placeholder="Número" class="form-control">
                                <div>{{$errors->first('direccion_numero')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="escuela_secundaria">Escuela secundaria:</label>
                        <input type="text" name= "escuela_secundaria" class="form-control" value = "{{old ('escuela_secundaria')}}" placeholder="Escuela secundaria">
                        <div>{{$errors->first('escuela_secundaria')}}</div>
                    </div>

                    <div class="form-group ">
                        <label for="rol">Selecciona el tipo de usuario a crear:</label>
                        <select name="rol" id="rol" class="form-control" >
                            <option disabled selected>Seleccionar</option>
                            @foreach ($user->roleOptions() as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                        <div>{{$errors->first('rol')}}</div>
                    </div>

                   <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name= "email" value = "{{old ('email')}}" class="form-control" placeholder="Email">
                        <div>{{$errors->first('email')}}</div>
                    </div>

                    <div class="form-group ">
                        <label for="password">Contraseña:</label>
                        <input type="password" name= "password" value = "{{old ('password')}}" class="form-control" placeholder="Contraseña">
                        <div>{{$errors->first('password')}}</div>
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
