@extends('layouts.plantillabase')
<title>DreamCar | Crear</title>
@section('contenido')
<h2>CREAR REGISTRO</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/vehiculos" method="POST">
    @csrf
    <div class="mb-3">
        <label for="id_marca" class="form-label">NOMBRE MARCA</label>
        <select name="id_marca" id="id_marca" class="form-control">
             @foreach($marcas as $marca)
                 <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
             @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">MODELO</label>
        <input id="modelo" name="modelo" type="number" class="form-control" tabindex="3">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">PRECIO</label>
        <input id="precio" name="precio" type="number" step="any" value="0" class="form-control" tabindex="4">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">DISPONIBLE (0 o 1)</label>
        <input id="disponible" name="disponible" type="text" class="form-control" tabindex="5">
    </div>
    
    <div>
        <a href="/vehiculos" class="btn btn-secondary" tabindex="6">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="7">GUARDAR</button>
    </div>
</form>