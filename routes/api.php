<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MarcasControllerAPI;
use App\Http\Controllers\API\VehiculosControllerAPI;
use App\Http\Controllers\API\ReservasControllerAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/marcas', [MarcasControllerAPI::class, 'index']);
Route::get('/marcas/show/{id}', [MarcasControllerAPI::class, 'show']);
Route::get('/marcas/marca/{marca}', [MarcasControllerAPI::class, 'buscarMarca']);

Route::get('/vehiculos', [VehiculosControllerAPI::class, 'index']);
Route::get('/vehiculos/show/{id}', [VehiculosControllerAPI::class, 'show']);
Route::get('/vehiculos/vehiculo/{id_marca}', [VehiculosControllerAPI::class, 'buscarVehiculoPorMarca']);
Route::post('/vehiculos/vehiculo/{modelo}', [VehiculosControllerAPI::class, 'buscarVehiculoPorModelo']);

Route::get('/reservas', [ReservasControllerAPI::class, 'index']);
Route::get('/reservas/show/{id}', [ReservasControllerAPI::class, 'show']);
Route::get('/reservas/reserva/{id}', [ReservasControllerAPI::class, 'mostrarDetalles']);
Route::get('/reservas/reserva/{email_cliente}', [ReservasControllerAPI::class, 'buscarPorMail']);
Route::post('/reservas/crearReserva', [ReservasControllerAPI::class, 'crearReserva']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

