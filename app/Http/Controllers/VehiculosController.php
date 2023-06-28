<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\ReservaDetalles;
use App\Models\Marca;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos.index')->with('vehiculos',$vehiculos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('vehiculos.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required|min:1|max:255',
            'precio' => 'required|min:3|max:255',
            'disponible' => 'required|min:0|max:1',
            'disponible' => 'required|in:0,1',
        ], [
            'modelo.required' => 'El campo modelo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'disponible.required' => 'El campo disponible es obligatorio (0 o 1)',
            'disponible.in' => 'El campo disponible debe ser 0 o 1',
        ]);

        $vehiculos = new Vehiculo(); 

        do {
            $randomId = mt_rand(100000, 999999); 
        } while (Vehiculo::where('id', $randomId)->exists());
        $vehiculos->id = $randomId;
        
        $vehiculos->id_marca = $request->get('id_marca');
        $vehiculos->modelo = $request->get('modelo');
        $vehiculos->precio = $request->get('precio');
        $vehiculos->disponible = $request->get('disponible');

        $vehiculos->save();

        return redirect('/vehiculos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehiculo = Vehiculo::with('vehiculo')->find($id);

        if (!$vehiculo) {
            return response()->json(['error' => 'No existe el Vehiculo'], 404);
        }

        return response()->json(['vehiculo' => $vehiculo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehiculo = Vehiculo::find($id);
        return view('vehiculos.edit')->with('vehiculo',$vehiculo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'modelo' => 'required|min:1|max:255',
            'precio' => 'required|min:3|max:255',
            'disponible' => 'required|min:0|max:1',
            'disponible' => 'required|in:0,1',
        ], [
            'modelo.required' => 'El campo modelo es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'disponible.required' => 'El campo disponible es obligatorio (0 o 1)',
            'disponible.in' => 'El campo disponible debe ser 0 o 1',
        ]);

        $vehiculo = Vehiculo::find($id);

        $vehiculo->id = $request->get('id');
        $vehiculo->id_marca = $request->get('id_marca');
        $vehiculo->modelo = $request->get('modelo');
        $vehiculo->precio = $request->get('precio');
        $vehiculo->disponible = $request->get('disponible');

        $vehiculo->save();

        return redirect('/vehiculos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        if($this->reservaAsociada($vehiculo)){
            session()->flash('error', 'No se puede borrar un vehiuclo asociado a una reserva');
            return redirect()->back();
        }

        $vehiculo->delete();
        session()->flash('success', 'Se elimino el vehiculo');
        return redirect('/vehiculos');
    }

    private function reservaAsociada($vehiculo)
    {
        return ReservaDetalles::where('id_vehiculo', $vehiculo->id)->exists();
    }
}
