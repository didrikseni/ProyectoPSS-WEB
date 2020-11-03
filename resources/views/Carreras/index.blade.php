
@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Carreras</h1>
                <table id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Año Inicio</th>
                            <th scope="col">Identificador</th>
                            <th scope="col">Departamento Responsable </th>                       
                            <th scope="col">Profesor Responsable</th>   
                            <th scope="col">Materias</th>                      
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
                            <th> 

                                <a href="/Carreras/{{$carrera->id}}/materias">Materias</a>

                            </th>                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="/js/MateriasTable.js" type="application/javascript"></script>
    <script src="/js/CarrerasTable.js" type="application/javascript"></script>
@endsection
