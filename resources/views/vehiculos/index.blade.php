@extends('layouts.plantillabase')

<title>DreamCar | Vehiculos</title>
@section('contenido')
<a href="/home" class="btn btn-primary">HOME</a>
<a href="vehiculos/create" class="btn btn-primary">AGREGAR VEHICULO</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ID MARCA</th>
            <th scope="col">MODELO</th>
            <th scope="col">PRECIO</th>
            <th scope="col">DISPONIBLE</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehiculos as $vehiculo)
        <tr>
            <td>{{ $vehiculo->id }}</td>
            <td>{{ $vehiculo->id_marca }}</td>
            <td>{{ $vehiculo->modelo }}</td>
            <td>{{ $vehiculo->precio }}</td>
            <td>{{ $vehiculo->disponible }}</td>
            <td>
                <form action="{{ route('vehiculos.destroy',$vehiculo->id) }}" method='POST'>
                    <a href="/vehiculos/{{ $vehiculo->id }}/edit" class="btn btn-info">EDITAR</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">BORRAR</button>
                <form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection