@extends('layouts.plantillabase')

<title>DreamCar | Marcas</title>

@section('contenido')
<a href="/home" class="btn btn-primary">HOME</a>
<a href="marcas/create" class="btn btn-primary">AGREGAR MARCA</a>

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
            <th scope="col">MARCA</th>
            <th scope="col">ACCIONES</th>
            <th scope="col"> </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marcas as $marca)
        <tr>
            <td>{{ $marca->id }}</td>
            <td>{{ $marca->marca }}</td>
            <td><a href="{{ route('marcas.edit', $marca) }}" class="btn btn-info">EDITAR</a></td>
            <td>
                <form action="/marcas/{{$marca->id}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="BORRAR">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection