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
                        <th></th>
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
                            <td>
                                <div class="btn-group">
                                    <a href="/Nota/{{ $nota->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-small">Editar</button>
                                    </a>
                                    <button type="button" class="btn red lighten-1 ml-2 btn-small"
                                            data-toggle="modal" data-target="#deleteModal"
                                            onclick="deleteSignature($(this))"
                                            data-name="{{$nota->name}}" data-id="{{$nota->id}}">Borrar
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
                            <h5 class="modal-title">Borrar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                <p>Esta seguro de borrar la nota ?</p>
                            </div>
                            <form id="formDeleteSignature" action="{{ route('Nota.destroy', 1) }}"
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
    <script src="/js/NotasTable.js" type="application/javascript"></script>
@endsection
