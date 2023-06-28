@extends('layouts.plantillabase')
<title>DreamCar | Editar</title>
@section('contenido')
<h2>EDITAR REGISTRO</h2>

<form action="/vehiculos/{{ $vehiculo->id }}" method="POST">
    @csrf <!-- directiva para el submit que nos crea un token oculto-->
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input id="id" name="id" value="{{$vehiculo->id}}" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">ID MARCA</label>
        <input id="id_marca" name="id_marca" value="{{$vehiculo->id_marca}}" type="text" class="form-control" tabindex="2">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">MODELO</label>
        <input id="modelo" name="modelo" value="{{$vehiculo->modelo}}" type="number" class="form-control" tabindex="3">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">PRECIO</label>
        <input id="precio" name="precio" value="{{$vehiculo->precio}}" type="number" step="any" class="form-control" tabindex="4">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">DISPONIBLE</label>
        <input id="disponible" name="disponible" value="{{$vehiculo->disponible}}" type="text" class="form-control" tabindex="5">
    </div>
    
    <div>
        <a href="/vehiculos" class="btn btn-secondary" tabindex="6">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="7">GUARDAR</button>
    </div>
</form>