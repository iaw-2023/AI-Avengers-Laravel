<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Vehiculo;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index')->with('marcas',$marcas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|min:3|max:255',
        ], [
            'marca.required' => 'El campo marca es obligatorio',
        ]);

        $marcas = new Marca(); 

        $marcas->marca = $request->get('marca');
        do {
            $randomId = mt_rand(1, 999999); 
        } while (Marca::where('id', $randomId)->exists());
        $marcas->id = $randomId;

        $marcas->save();
        return redirect('/marcas')->with('success', 'Marca creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marca = Marca::with('marca')->find($id);
        if (!$marca) {
            return response()->json(['error' => 'No existe la Marca'], 404);
        }

        return response()->json(['marca' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marca = Marca::find($id);
        return view('marcas.edit')->with('marca',$marca);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'marca' => 'required|min:3|max:255',
            'id' => 'required|min:1|max:255'
        ], [
            'marca.required' => 'El campo marca es obligatorio',
            'id.required' => 'El campo ID es obligatorio'
        ]);

        $marca = Marca::find($id);

        $marca->id = $request->get('id');
        $marca->marca = $request->get('marca');

        $marca->save();

        return redirect('/marcas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $marca = Marca::findOrFail($id);
        if($this->vehiculoAsociado($marca)){
            session()->flash('error', 'No se puede borrar una marca asociada a un vehiculo');
            return redirect()->back();
        }
        
        $marca->delete();
        session()->flash('success', 'Se elimino la marca');
        return redirect('/marcas');
    }

    private function vehiculoAsociado($marca)
    {
        return Vehiculo::where('id_marca', $marca->id)->exists();
    }
}
