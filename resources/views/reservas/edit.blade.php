@extends('layouts.plantillabase')
<title>DreamCar | Editar</title>
@section('contenido')
<h2>EDITAR REGISTRO</h2>

<form action="/reservas/{{ $reserva->id }}" method="POST">
    @csrf <!-- directiva para el submit que nos crea un token oculto-->
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input id="id" name="id" value="{{$reserva->id}}" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">EMAIL</label>
        <input id="email" name="email" value="{{$reserva->email}}" type="text" class="form-control" tabindex="2">
    </div>
    
    <div>
        <a href="/reservas" class="btn btn-secondary" tabindex="3">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="4">GUARDAR</button>
    </div>
</form>