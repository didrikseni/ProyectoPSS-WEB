@extends('layouts.app')

@section('content')

    @if ($tipo == 'debiles')
        <h2> Correlativas débiles de la materia {{ $materia->nombre}}</h2>
    @else
        <h2> Correlativas fuertes de la materia {{ $materia->nombre}}</h2>
    @endif

    <div class="row">
        <table style="width:100%">
            <tr>
                <th>Materia</th>
                <th>identificador</th>
                <th>Año</th>
                <th>Cuatrimestre</th>
            </tr>
            @foreach($correlativas as $corr)
                <tr>
                    <td>{{ $corr->nombre }}</td>
                    <td>{{ $corr->id_str }}</td>
                    <td>{{ $corr->anio }}</td>

                </tr>
            @endforeach

        </table>

        <ul>

        </ul>
    </div>

@endsection
