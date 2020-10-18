@extends('layouts.app')

@section('content')
    @if(session('success'))
        <h1>{{session('success')}}</h1>
    @endif

    <div class="page-content">
        <div class="card justify-content-center m-5">
            <div class="card-header">
                <h4 class="text-center"> Ingrese los siguientes datos para asociar correlativas a una materia </h4>
            </div>

            <div class="card-body ">
                <form method="POST" action="/correlativas" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="materia">Materia (*)</label>
                                <div>
                                    <input class="input-group form-control @error('materia') alert-danger @enderror"
                                           type="text" name="materia" id="materia" value="{{ old('materia') }}">
                                    @error('materia')
                                    <p class="badge badge-danger">{{ $errors->first('materia') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="label" for="correlativa">Correlativas (*)</label>
                                <div>
                                    <input
                                        class="input-group form-control @error('correlativa') alert-danger @enderror"
                                        type="text" name="correlativa" id="correlativa"
                                        value="{{ old('correlativa') }}">
                                    @error('correlativa')
                                    <p class="badge badge-danger">{{ $errors->first('correlativa') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <h4> (*) Campo obligatorio </h4>
                        </div>
                    </div>

                    <br>

                    <div class="row my-3">
                        <div class="col-auto">
                            <div class="form-group">
                                <label for="tipo">Tipo de Correlativa (*)</label>
                                <select class="form-control @error('tipo') alert-danger @enderror"
                                        type="text" name="tipo" id="tipo" value="{{ old('tipo') }}">
                                    <option disabled selected>Seleccionar</option>
                                    <option value="1">Fuerte</option>
                                    <option value="0">Debil</option>
                                </select>
                                @error('tipo')
                                <p class="badge badge-danger">{{ $errors->first('tipo') }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="form-group">
                                <div class="col-auto">
                                    <button class="waves-effect waves-light btn blue">Aceptar</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-auto">
                                    <button class="waves-effect waves-light btn blue">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


