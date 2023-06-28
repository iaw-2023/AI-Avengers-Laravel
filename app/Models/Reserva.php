<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehiculo;
use App\Models\ReservaDetalles;


class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email_cliente'
    ];

    public function vehiculo()
    {
        return $this->belongsToMany(Vehiculo::class, 'reserva_vehiculo', 'reserva_id', 'vehiculo_id');
    }

    public function detalles()
    {
        return $this->hasOne(ReservaDetalles::class, 'id');
    }
}
