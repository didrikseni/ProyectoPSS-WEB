@extends('layouts/app')

@section('content')

<div class="content">                
       
    <div class="col-12">
        <div class="title m-b-md">
            <h1>Carreras</h1>
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Año Inicio</th>
                        <th scope="col">Identificador</th>
                        <th scope="col"> Departamento Responsable </th>                       
                        <th scope="col">Profesor Responsable</th>                         
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carreras as $carrera)
                        <tr>
                            <th>{{$carrera->nombre}}</th>
                            <th>{{$carrera->anio_inicio}} </th>
                            <th>{{$carrera->id_str}} </th>
                            <th>{{App\Models\Departamentos::where('id', '=', $carrera->departamento_responsable)->first()->nombre}} </th>                      
                            <th>{{App\Models\User::where('id', '=', $carrera->profesor_responsable)->first()->nombre}}</th>                            
                        </tr>                            
                    @endforeach                         
                </tbody>
            </table>
        </div>        
    </div>
              
                              
 </div>          
@endsection