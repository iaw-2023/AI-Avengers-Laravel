<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;

class MarcasControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/marcas",
     *     summary="Obtener lista de marcas",
     *     description="Retorna una lista de todas las marcas en la base de datos",
     *     tags={"Marcas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de marcas encontrada",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="marca", type="string", maxLength=50, nullable=true, example="Nombre de una Marca")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    /**
     * @OA\Get(
     *     path="/rest/marcas/show/{id}",
     *     summary="Obtener una marcas por id",
     *     description="Renorna los detalles de una marca",
     *     tags={"Marcas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la marca",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la marca con id seleccionado",
     *         @OA\JsonContent(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="marca", type="string", maxLength=50, nullable=true, example="Nombre de una Marca")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Marca no encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $marca = Marca::find($id);
        if (!$marca) {
            return response()->json(['error' => 'No existe la Marca'], 404);
        }
        return response()->json($marca);  
    }

     /**
     * @OA\Get(
     *     path="/rest/marcas/marca/{marca}",
     *     summary="Buscar marca por nombre",
     *     description="Retorna una marca",
     *     tags={"Marcas"},
     *     @OA\Parameter(
     *         name="marca",
     *         in="path",
     *         description="Nombre de la marca a buscar",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Marca encontrada",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="marca", type="string", maxLength=50, nullable=true, example="Nombre de una Marca")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontro la marca",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function buscarMarca(string $marca)
    {
        $marcas = Marca::where('marca', $marca)->get();
        if (!$marcas) {
            return response()->json(['error' => 'No se encuentra la Marca'], 404);
        }
        return response()->json($marcas);
    }
}

?>