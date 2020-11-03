@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Notas de Examen</h1>
                </br>
                <h3> Notas Cursadas </h3>
                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">LU</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Materia</th>
                        <th scope="col"> Nota </th>                       
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($notasCursadas as $nota)
                        <tr>
                            <th>{{$nota->LU_alumno}}</th>
                            <th>{{App\Models\User::where('id', '=', $nota->LU_alumno)->first()->nombre}} </th>
                            <th>{{App\Models\User::where('id', '=', $materia->LU_alumno)->first()->apellido}} </th>
                            <th> {{App\Models\Materia::where('id', '=', App\Models\MesaExamen::where('id', '=', $nota->id_mesa_examen)->first()->id)->first()->nombre}} </th>
                            <th>{{$nota->calificacion}}</th>
                        </tr>                       
                    @endforeach
                    </tbody>
                </table>



                <!-- </br>
                <h3> Notas Finales </h3>
                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">LU</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Materia</th>
                        <th scope="col"> Nota </th>                       
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($notasFinales as $nota)
                        <tr>
                            <th>{{$nota->LU_alumno}}</th>
                            <th>{{App\Models\User::where('id', '=', $nota->LU_alumno)->first()->nombre}} </th>
                            <th>{{App\Models\User::where('id', '=', $materia->LU_alumno)->first()->apellido}} </th>
                            <th> {{App\Models\Materia::where('id', '=', App\Models\MesaExamen::where('id', '=', $nota->id_mesa_examen)->first()->id)->first()->nombre}} </th>
                            <th>{{$nota->calificacion}}</th>
                        </tr>                       
                    @endforeach
                    </tbody>
                </table> -->



            </div>           
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="/js/MateriasTable.js" type="application/javascript"></script>
@endsection
