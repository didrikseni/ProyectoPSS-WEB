
@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Materias de </h1>
                <h3>{{$carrera->nombre}}</h3>
                </br>
                <a href="/Carreras" role="button" class="btn ">
                        Volver a carreras                       
                </a>

                <table id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Departamento</th>          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($materias as $materia)
                        <tr>
                            <th>{{$materia->nombre}}</th>
                            <th>{{$materia->departamento}} </th>                                                  
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
@endsection
