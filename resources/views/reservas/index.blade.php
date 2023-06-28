@extends('layouts.plantillabase')

<title>DreamCar | Reservas</title>
@section('contenido')
<a href="/home" class="btn btn-primary">HOME</a>
<a href="reservas/create" class="btn btn-primary">AGREGAR RESERVA</a>

@if(session('success'))
    <div id="alert" class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div id="alert" class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">EMAIL</th>
            <th scope="col"> </th>
            <th scope="col"> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservas as $reserva)
        <tr>
            <td>{{ $reserva->id }}</td>
            <td>{{ $reserva->email }}</td>
            <td><a href="/reservas/{{ $reserva->id }}/edit" class="btn btn-info">EDITAR</a></td>
            <td>
                <form action="{{ route('reservas.destroy',$reserva->id) }}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">BORRAR</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="reservasDetalle" class="btn btn-primary">VER DETALLES DE LAS RESERVAS</a>
@endsection