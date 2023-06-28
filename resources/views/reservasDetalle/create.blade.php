@extends('layouts.plantillabase')
<title>DreamCar | Crear</title>
@section('contenido')
<h2>CREAR REGISTRO</h2>

<form action="/reservasDetalle" method="POST">
    @csrf <!-- directiva para el submit que nos crea un token oculto-->
    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input id="id" name="id" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">PRECIO</label>
        <input id="precio" name="precio" type="number" class="form-control" tabindex="2">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">ID RESERVA</label>
        <input id="id_reserva" name="id_reserva" type="text" class="form-control" tabindex="3">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">ID VEHICULO</label>
        <input id="id_vehiculo" name="id_vehiculo" type="text" class="form-control" tabindex="4">
    </div>
    
    <div>
        <a href="/reservasDetalle" class="btn btn-secondary" tabindex="5">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="6">GUARDAR</button>
    </div>
</form>