@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Materias</h1>
                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">ID</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Asistente</th>
                        <th scope="col">Correlativas debiles</th>
                        <th scope="col">Correlativas fuertes</th>
                        <th scope="col">Año de la carrera</th>
                        <th scope="col">Cuatrimestre</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($materias as $materia)
                        <tr>
                            <th>{{$materia->nombre}}</th>
                            <th>{{$materia->id_str}} </th>
                            <th scope="col">{{App\Models\Departamentos::where('id', '=', $materia->departamento)->first()->nombre}}</th>
                            @if ($materia->id_profesor !== null)
                                <th scope="col">{{App\Models\User::where('id', '=', $materia->id_profesor)->first()->nombre}}</th>
                            @else
                                <th scope="col">{{ 'Sin profesor' }}</th>
                            @endif
                            @if ($materia->id_asistente !== null)
                                <th scope="col">{{App\Models\User::where('id', '=', $materia->id_asistente)->first()->nombre}}</th>
                            @else
                                <th scope="col">{{ 'Sin asistente' }}</th>
                            @endif
                            <th scope="col"> <a href="/correlatividad/debil/{{ $materia->id }}">ver</a> </th>
                            <th scope="col"> <a href="/correlatividad/fuerte/{{ $materia->id }}">ver</a> </th>
                            <th scope="col"> - </th>
                            <th scope="col"> - </th>
                            @if (auth()->user()->isAdmin())
                            <td>
                                <div class="btn-group">
                                    <a href="/materias/{{ $materia->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-small">Editar</button>
                                    </a>
                                    <button type="button" class="btn red lighten-1 ml-2 btn-small"
                                            data-toggle="modal" data-target="#deleteModal"
                                            onclick="deleteSignature($(this))"
                                            data-name="{{$materia->name}}" data-id="{{$materia->id}}">Borrar
                                    </button>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Borrar materia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                <p>Esta seguro de borrar la materia <b id="name">{{ $materia->name }}</b> ?</p>
                            </div>
                            <form id="formDeleteSignature" action="{{ route('materias.destroy', 1) }}"
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
    <script src="/js/MateriasTable.js" type="application/javascript"></script>
@endsection
