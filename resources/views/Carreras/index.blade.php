@extends('layouts/app')

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
                        <th scope="col"> Departamento Responsable</th>
                        <th scope="col">Profesor Responsable</th>
                        <th scope="col">Materias</th>
                        <th></th>
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
                            <th><a href="/Carreras/{{ $carrera->id }}/materias">Ver materias</a></th>
                            <td>
                                <div class="btn-group">
                                    <a href="/Carreras/{{ $carrera->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-small">Editar</button>
                                    </a>
                                    <button type="button" class="btn red lighten-1 ml-2 btn-small"
                                            data-toggle="modal" data-target="#deleteModal"
                                            onclick="deleteSignature($(this))"
                                            data-name="{{$carrera->name}}" data-id="{{$carrera->id}}">Borrar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Borrar carrera</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                <p>Esta seguro de borrar la carrera ?</p>
                            </div>
                            <form id="formDeleteSignature" action="{{ route('Carreras.destroy', 1) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" id="signatureHideDelete">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-small" data-dismiss="modal">Close</button>
                            <button type="submit" id="deleteButton" class="btn red lighten-1 ml-2 btn-small"
                                    form="formDeleteSignature">Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="application/javascript"></script>
    <script src="/js/CarrerasTable.js" type="application/javascript"></script>
@endsection
