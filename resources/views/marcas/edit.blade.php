@extends('layouts.plantillabase')
<title>DreamCar | Editar</title>
@section('contenido')
<h2>EDITAR REGISTRO</h2>

<form action="/marcas/{{ $marca->id }}" method="POST">
    @csrf <!-- directiva para el submit que nos crea un token oculto-->
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input id="id" name="id" value="{{$marca->id}}" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">MARCA</label>
        <input id="marca" name="marca" value="{{$marca->marca}}" type="text" class="form-control" tabindex="2">
    </div>
    
    <div>
        <a href="/marcas" class="btn btn-secondary" tabindex="3">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="4">GUARDAR</button>
    </div>
</form>