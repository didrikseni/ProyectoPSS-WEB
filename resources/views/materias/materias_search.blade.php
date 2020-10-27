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
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                            <th scope="col"> -</th>
                            <td>
                                <div class="btn-group">
                                    <a href="#">
                                        <button type="button" class="btn btn btn-raised btn-primary btn-sm">Editar</button>
                                    </a>
                                    <button type="button" class="btn btn btn-raised btn-danger btn-sm ml-1 delete"
                                            data-toggle="modal" data-target="#deleteModal"
                                            data-name="{{$materia->name}}" data-id="{{$materia->id}}">Borrar
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
                            <h5 class="modal-title">Delete artist</h5>
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
                            <button type="button" class="btn btn btn-raised btn-secondary mx-2" data-dismiss="modal">Close</button>
                            <button type="submit" id="deleteButton" class="btn btn btn-raised btn-danger xm-2"
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



{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="page-content m-5">--}}
{{--        <div class="justify-content-center">--}}
{{--            <div class="title m-b-md text-center">--}}
{{--                <h1>Materias</h1>--}}
{{--                <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Nombre</th>--}}
{{--                        <th scope="col">ID</th>--}}
{{--                        <th scope="col">Departamento</th>--}}
{{--                        <th scope="col">Profesor</th>--}}
{{--                        <th scope="col">Asistente</th>--}}
{{--                        <th scope="col">Correlativas debiles</th>--}}
{{--                        <th scope="col">Correlativas fuertes</th>--}}
{{--                        <th scope="col">Año de la carrera</th>--}}
{{--                        <th scope="col">Cuatrimestre</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach ($materias as $materia)--}}
{{--                        <tr>--}}
{{--                            <th>{{$materia->nombre}}</th>--}}
{{--                            <th>{{$materia->id_str}} </th>--}}
{{--                            <th scope="col">{{App\Models\Departamentos::where('id', '=', $materia->departamento)->first()->nombre}}</th>--}}
{{--                            @if ($materia->id_profesor !== null)--}}
{{--                                <th scope="col">{{App\Models\User::where('id', '=', $materia->id_profesor)->first()->nombre}}</th>--}}
{{--                            @else--}}
{{--                                <th scope="col">{{ 'Sin profesor' }}</th>--}}
{{--                            @endif--}}
{{--                            @if ($materia->id_asistente !== null)--}}
{{--                                <th scope="col">{{App\Models\User::where('id', '=', $materia->id_asistente)->first()->nombre}}</th>--}}
{{--                            @else--}}
{{--                                <th scope="col">{{ 'Sin asistente' }}</th>--}}
{{--                            @endif--}}
{{--                            <th scope="col"> -</th>--}}
{{--                            <th scope="col"> -</th>--}}
{{--                            <th scope="col"> -</th>--}}
{{--                            <th scope="col"> -</th>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                --}}
{{--            </div>--}}
{{--        </div>--}}

{{--                <div class="justify-content-center m-5">--}}
{{--                    <div class="col-9">--}}
{{--                        <form method="POST" action="/materias/search" enctype="multipart/form-data">--}}
{{--                            @csrf--}}

{{--                            <input class="invisible disabled" value="" name="carrera" id="carrera"/>--}}
{{--                            <input class="invisible disabled" value="" name="materia" id="materia"/>--}}

{{--                            <div class="row my-3">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="cform">Seleccione la carrera</label>--}}
{{--                                        <select class="form-control @error('cform') alert-danger @enderror"--}}
{{--                                                type="text" name="cform" id="cform" value="{{ old('cform') }}"--}}
{{--                                                id="cform" onselect="selectCarrera(this)">--}}
{{--                                            @foreach($carreras as $carrera)--}}
{{--                                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('cform')--}}
{{--                                        <p class="badge badge-danger">{{ $errors->first('cform') }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="label" for="cformid">O ingrese el identificador de la carrera</label>--}}
{{--                                        <div>--}}
{{--                                            <input--}}
{{--                                                class="input-group form-control @error('cformid') alert-danger @enderror"--}}
{{--                                                type="text" name="cformid" id="carreraid" value="{{ old('cformid') }}"--}}
{{--                                                onchange="selectCarrera(this)">--}}
{{--                                            @error('cformid')--}}
{{--                                            <p class="badge badge-danger">{{ $errors->first('cformid') }}</p>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row my-3 disabled" id="materias_div">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="mform">Seleccione la materia</label>--}}
{{--                                        <select class="form-control @error('mform') alert-danger @enderror"--}}
{{--                                                type="text" name="mform" id="mform" value="{{ old('mform') }}" id="mform"--}}
{{--                                                onselect="selectMateria(this)">--}}
{{--                                            @foreach($materias as $materia)--}}
{{--                                                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('mform')--}}
{{--                                        <p class="badge badge-danger">{{ $errors->first('mform') }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="label" for="mformid">O ingrese el identificador de la materia</label>--}}
{{--                                        <div>--}}
{{--                                            <input--}}
{{--                                                class="input-group form-control @error('mformid') alert-danger @enderror"--}}
{{--                                                type="text" name="mformid" id="mformid" value="{{ old('mformid') }}"--}}
{{--                                                onchange="selectMateria(this)">--}}
{{--                                            @error('mformid')--}}
{{--                                            <p class="badge badge-danger">{{ $errors->first('mformid') }}</p>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <br>--}}
{{--                            <div class="row justify-content-center">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <button type="submit" class="waves-effect waves-light btn">Buscar</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                        @if($matInfo !== null)--}}
{{--                            <br>--}}
{{--                            <div class="m-5">--}}
{{--                                <h4>Información</h4>--}}
{{--                                <div class="col">--}}
{{--                                    <p class="text-xl-left">Nombre: {{ $matInfo->nombre }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Identificador: {{ $matInfo->id_str }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Departamento responsable: {{ $matInfo->departamento }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Profesor: {{ $matInfo->profesor }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Asistente: {{ $matInfo->asistente }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Correlativas debiles: {{ $matInfo->correlatDebiles }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Correlativas fuertes: {{ $matInfo->correlatFuertes }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Año de la carrera: {{ $matInfo->anio }}</p>--}}
{{--                                    <hr>--}}
{{--                                    <p class="text-xl-left">Cuatrimestre: {{ $matInfo->cuatrimestre }}</p>--}}
{{--                                    <hr>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--    </div>--}}
{{--@endsection--}}


{{--@section('scripts')--}}
{{--    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="application/javascript"></script>    <script src="/js/MateriasTable.js" type="application/javascript"></script>--}}
{{--    <script src="/js/MateriasTable.js" type="application/javascript"></script>--}}
{{--@endsection--}}



