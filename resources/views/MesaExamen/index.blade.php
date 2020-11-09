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
                                <p>Esta seguro de borrar la mesa de exámen <b id="name">{{ $mesa->name }}</b> ?</p>
                            </div>
                            <form id="formDeleteSignature" action="{{ route('MesaExamen.destroy', 1) }}"
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
    <script src="/js/MesaExamenTable.js" type="application/javascript"></script>
@endsection
