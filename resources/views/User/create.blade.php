@extends('layouts.app')

@section('content')

<div class="content">
    <div class="m-5">
        
        <div class="col-9">
            <div class="title m-b-md">
                <h1>Agregar nuevo usuario</h1>
            </div>
        </div>
        <div class="col-9">
            <h5> (*) Campo obligatorio </h5>
        </div>
        </br>

        
        <div class="col-9">
            <form action="/User" method = "POST" class="py-3">

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
                        <label for="apellido">Apellido: (*)</label>
                        <div>
                            <input type="text" name= "apellido" value = "{{old ('apellido')}}" class="form-control" placeholder="Apellido">
                            @error('apellido')
                                <p class="badge badge-danger">{{ $errors->first('apellido') }}</p>
                            @enderror
                        </div>                        
                    </div>
                </div>


                <div class="form-row my-4">
                    <div class="col">
                        <label for="fecha_nacimiento">Fecha de nacimiento: (*)</label>
                        <div>
                            <input type="date" name= "fecha_nacimiento"  class="form-control" value = "{{old ('fecha_nacimiento')}}">
                            @error('fecha_nacimiento')
                                <p class="badge badge-danger">{{ $errors->first('fecha_nacimiento') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <label for="lugar_nacimiento">Lugar de nacimiento: (*)</label>
                        <div>
                            <input type="text" name= "lugar_nacimiento" value = "{{old ('lugar_nacimiento')}}" class="form-control" placeholder="Lugar de nacimiento">
                            @error('lugar_nacimiento')
                                <p class="badge badge-danger">{{ $errors->first('lugar_nacimiento') }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row my-4">
                    <div class="col col-lg-3" >
                        <label for="tipo_documento">Tipo Documento: (*)</label>
                        <div>
                            <select name="tipo_documento" id="tipo_documento" class="form-control" >
                                <option disabled selected>Seleccionar</option>
                                @foreach ($user->documentOptions() as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento')
                                <p class="badge badge-danger">{{ $errors->first('tipo_documento') }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-lg-3" >
                        <label for="DNI">Número de documento: (*)</label>
                        <div>
                            <input type="number" name= "DNI" value = "{{old ('DNI')}}" class="form-control" placeholder="Número Documento">
                            @error('DNI')
                                <p class="badge badge-danger">{{ $errors->first('DNI') }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col ">
                        <label for="numero_telefono">Número de telfono: (*)</label>
                        <div>
                            <input type="text" name= "numero_telefono" value = "{{old ('numero_telefono')}}" class="form-control" placeholder="Número de telefono">
                            @error('numero_telefono')
                                <p class="badge badge-danger">{{ $errors->first('numero_telefono') }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="direccion_calle">Dirección: (*)</label>
                    <div class="form-row ">
                        <div class="col">
                            <div>
                                <input type="text" name= "direccion_calle" value = "{{old ('direccion_calle')}}" placeholder="Calle" class="form-control">
                                @error('direccion_calle')
                                    <p class="badge badge-danger">{{ $errors->first('direccion_calle') }}</p>
                                @enderror
                            </div>                            
                        </div>
                        <div class="col">
                            <div>
                                <input type="number" name= "direccion_numero" value = "{{old ('direccion_numero')}}" placeholder="Número" class="form-control">
                                @error('direccion_numero')
                                    <p class="badge badge-danger">{{ $errors->first('direccion_numero') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="escuela_secundaria">Escuela secundaria:</label>
                    <div>
                        <input type="text" name= "escuela_secundaria" class="form-control" value = "{{old ('escuela_secundaria')}}" placeholder="Escuela secundaria">
                        @error('escuela_secundaria')
                            <p class="badge badge-danger">{{ $errors->first('escuela_secundaria') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="rol">Selecciona el tipo de usuario a crear: (*)</label>
                    <div>
                        <select name="rol" id="rol" class="form-control" >
                            <option disabled selected>Seleccionar</option>
                            @foreach ($user->roleOptions() as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('rol')
                            <p class="badge badge-danger">{{ $errors->first('rol') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email: (*)</label>
                    <div>
                        <input type="email" name= "email" value = "{{old ('email')}}" class="form-control" placeholder="Email">
                        @error('email')
                            <p class="badge badge-danger">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password">Contraseña: (*)</label>
                    <div>
                        <input type="password" name= "password" value = "{{old ('password')}}" class="form-control" placeholder="Contraseña">
                        @error('password')
                            <p class="badge badge-danger">{{ $errors->first('password') }}</p>
                        @enderror
                    </div>
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
