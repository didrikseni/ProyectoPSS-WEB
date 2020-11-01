@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Mesas de Examen</h1>
                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Tipo Examen</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Inscriptos</th>
                        <th scope="col">Profesor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mesa_examen as $mesa)
                        <tr>
                            <th>{{$mesa->id}}</th>
                            <th>{{App\Models\Materia::where('id', '=', $mesa->id_materia)->first()->nombre}} </th>
                            <th>{{$mesa->fecha}}</th>
                            <th scope="col"> {{$mesa->horario}}</th>
                            <th scope="col"> {{$mesa->tipo_examen}}</th>
                            <th scope="col"> {{$mesa->observaciones}}</th>
                            <th scope="col"> {{$mesa->notas()->count()}}</th>
                            <th>{{App\Models\User::where('id', '=', App\Models\Materia::where('id', '=', $mesa->id_materia)->first()->id_profesor)->first()->nombre}}</th>
                           
                            <td>
                                <div class="btn-group">
                                    <a href="/materias/{{ $mesa->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-small">Editar</button>
                                    </a>
                                    <button type="button" class="btn red lighten-1 ml-2 btn-small"
                                            data-toggle="modal" data-target="#deleteModal"
                                            onclick="deleteSignature($(this))"
                                            data-name="{{$mesa->name}}" data-id="{{$mesa->id}}">Borrar
                                    </button>
                                </div>
                            </td>
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
