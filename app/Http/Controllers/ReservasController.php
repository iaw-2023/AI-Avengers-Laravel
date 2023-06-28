<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaDetalles;
use App\Models\Marca;
use App\Models\Vehiculo;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::all();
        return view('reservas.index')->with('reservas',$reservas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|min:3|max:255',
        ], [
            'email.required' => 'El campo email es obligatorio',
        ]);
        $reservas = new Reserva();

        do {
            $randomId = mt_rand(1, 999999); 
        } while (Reserva::where('id', $randomId)->exists());
        $reservas->id = $randomId;

        $reservas->email = $request->get('email');

        $anioInicio = rand(2022, 2023);
        $mesInicio = rand(1, 12);
        $diaInicio = rand(1, 28);
        $duracion = rand(1, 7); // La reserva tendrá una duración de 1 a 7 días
        $fechaInicio = date("Y-m-d", strtotime("$anioInicio-$mesInicio-$diaInicio"));
        $fechaFinal = date("Y-m-d", strtotime("$fechaInicio +$duracion day"));
    
        $reservas->email = $request->get('email');
        $reservas->fecha_inicio = $fechaInicio;
        $reservas->fecha_final = $fechaFinal;

        $reservas->save();

        return redirect('/reservas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reserva = Reserva::with('vehiculo')->find($id);
        $marcas = Marca::all();

        $vehiculosAsociados = $reserva->vehiculo;

        return view('reservas.edit')->with([
            'reserva' => $reserva,
            'marcas' => $marcas,
            'vehiculosAsociados' => $vehiculosAsociados
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reserva = Reserva::find($id);

        $reserva->id = $request->get('id');
        $reserva->email = $request->get('email');

        $reserva->save();

        return redirect('/reservas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::findOrFail($id);

        if($this->reservaDetalleAsociada($reserva)){
            session()->flash('error', 'No se puede borrar una reserva asociada a detalles');
            return redirect()->back();
        }

        $reserva->delete();
        session()->flash('success', 'Se elimino la reserva');
        return redirect('/reservas');
    }

    private function reservaDetalleAsociada($reserva)
    {
        return ReservaDetalles::where('id_reserva', $reserva->id)->exists();
    }
}
