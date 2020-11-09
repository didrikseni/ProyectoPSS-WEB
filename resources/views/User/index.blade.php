@extends('layouts/app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="page-content m-5">
        <div class="justify-content-center">
            <div class="title m-b-md text-center">
                <h1>Usuarios</h1>
                <table id="example" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">LU</th>
                        <th scope="col"> Rol</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">Usuario</th>
                            <th scope="col">Documento</th>
                        @endif
                        <th scope="col">Email</th>
                        @if(auth()->user()->isAdmin())
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Número de telefono</th>
                            <th scope="col">Escuela Secundaria</th>
                        @endif
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->nombre}}</th>
                            <th>{{$user->apellido}} </th>
                            <th>{{$user->legajo}} </th>
                            <th>{{$user->rol}} </th>
                            @if(auth()->user()->isAdmin())
                                <th>{{$user->nombre_usuario}} </th>
                                <th>{{$user->tipo_documento . ' '. $user->DNI}}</th>
                            @endif
                            <th>{{$user->email}}</th>
                            @if(auth()->user()->isAdmin())
                                <th>{{$user->fecha_nacimiento}}</th>
                                <th>{{$user->direccion_calle . ' '. $user->direccion_numero}}</th>
                                <th>{{$user->numero_telefono}}</th>
                                <th>{{$user->escuela_secundaria}}</th>
                            @endif
                            @if(auth()->user()->isAdmin())
                            <td>
                                <div class="btn-group">
                                    <a href="/User/{{ $user->id }}/edit">
                                        <button type="button" class="btn btn-primary btn-small">Editar</button>
                                    </a>
                                    <button type="button" class="btn red lighten-1 ml-2 btn-small"
                                            data-toggle="modal" data-target="#deleteModal"
                                            onclick="deleteSignature($(this))"
                                            data-name="{{$user->name}}" data-id="{{$user->id}}">Borrar
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
                            <h5 class="modal-title">Borrar usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                <p>Esta seguro de borrar el usuario ?</p>
                            </div>
                            <form id="formDeleteSignature" action="{{ route('User.destroy', 1) }}"
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
    <script src="/js/UserTable.js" type="application/javascript"></script>
@endsection
