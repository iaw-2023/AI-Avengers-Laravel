<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservaDetalles;

class ReservasDetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservasD = ReservaDetalles::all();
        return view('reservasDetalle.index')->with('reservasD',$reservasD);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservasDetalle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservasD = new ReservaDetalles();

        $reservasD->id = $request->get('id');
        $reservasD->precio = $request->get('precio');
        $reservasD->id_reserva = $request->get('id_reserva');
        $reservasD->id_vehiculo = $request->get('id_vehiculo');

        $reservasD->save();

        return redirect('/reservasDetalles');
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
        $reservaD = ReservaDetalles::find($id);
        return view('reservasDetalle.edit')->with('reservaD',$reservaD);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservaD = ReservaDetalles::find($id);

        $reservasD->id = $request->get('id');
        $reservasD->precio = $request->get('precio');
        $reservasD->id_reserva = $request->get('id_reserva');
        $reservasD->id_vehiculo = $request->get('id_vehiculo');


        $reservaD->save();

        return redirect('/reservasDetalle');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservaD = ReservaDetalles::find($id);

        $reservaD->delete();

        return redirect('/reservasDetalle');
    }
}
