@extends('layouts.app')

@section('content')

<div class="content">

     <div class="d-flex justify-content-center">

        <div class="col-9">
            <div class="row">
                <div class="title m-b-md">
                    <h1>Nota cargada exitosamente</h1>
                </div>
            </div>
            <div class="row">
                <label for="nombre">Nota= {{$nota->calificacion}}</label>
            </div>

            <div class="row">
                <label for="nombre">Alumno= {{$nota->LU_alumno}}</label>
            </div>

            <div class="row">
                <label for="nombre">Mesa= {{$nota->id_mesa_examen}}</label>
            </div>

            <p>
                <a href="/Nota" role="button" class="btn btn-primary">
                    Volver a Notas
                </a>
            </p>

        </div>
    </div>


 </div>
@endsection
