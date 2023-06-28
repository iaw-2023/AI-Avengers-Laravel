@extends('layouts.plantillabase')

<title>DreamCar | ReservasDetalles</title>
@section('contenido')
<a href="/home" class="btn btn-primary">HOME</a>
<a href="reservasDetalle/create" class="btn btn-primary">AGREGAR RESERVA DETALLES</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ID RESERVA</th>
            <th scope="col">ID VEHICULO</th>
            <th scope="col">PRECIO</th>
            <th scope="col">ACCIONES</th>
            <th scope="col"> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservasD as $reservaD)
        <tr>
            <td>{{ $reservaD->id }}</td>
            <td>{{ $reservaD->id_reserva }}</td>
            <td>{{ $reservaD->id_vehiculo }}</td>
            <td>{{ $reservaD->precio }}</td>
            <td>
                <form action="{{ route('reservasDetalle.destroy',$reservaD->id) }}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">BORRAR</button>
                </form>
            </td>
            <td><a href="/reservasDetalle/{{ $reservaD->id }}/edit" class="btn btn-info">EDITAR</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection