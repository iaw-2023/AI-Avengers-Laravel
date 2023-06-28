@extends('layouts.mainHead')

<!DOCTYPE html>
<html>
    <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/home"><button type="button" class="btn btn-primary">DreamCar</button></a>
                </div>
                <ul class="nav navbar-nav mr-auto">
                    <li><a href="/marcas"><button type="button" class="btn btn-outline-primary">Marcas</button></a></li>
                    <li><a href="/vehiculos"><button type="button" class="btn btn-outline-primary">Vehiculo</button></a></li>
                    <li><a href="/reservas"><button type="button" class="btn btn-outline-primary">Reserva</button></a></li>
                    <li><a href="/dashboard"><button type="button" class="btn btn-danger">Dashboard</button></a></li>
                </ul>
            </div>
    </nav>
</html>