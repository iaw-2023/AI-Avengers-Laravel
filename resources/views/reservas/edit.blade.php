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
    <div class="mb-3">
    <label for="" class="form-label">VEHÍCULOS ASOCIADOS</label>
    <div class="row">
            @foreach ($vehiculosAsociados as $vehiculo)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $vehiculo->marca->marca }}</h5>
                            <p class="card-text">Modelo: {{ $vehiculo->modelo }}</p>
                            <p class="card-text">Precio: {{ $vehiculo->precio }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <a href="/reservas" class="btn btn-secondary" tabindex="3">CANCELAR</a>
        <button type="submit" class="btn btn-primary" tabindex="4">GUARDAR</button>
    </div>
</form>