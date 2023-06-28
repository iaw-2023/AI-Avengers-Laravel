<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Marca;

class VehiculosControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/vehiculos",
     *     summary="Obtener lista de vehiculos",
     *     description="Retorna una lista de todas los vehiculos en la base de datos",
     *     tags={"Vehiculos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de vehiculos encontrada",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="id_marca", type="integer", example="99"),
     *                 @OA\Property(property="modelo", type="integer", example="2010"),
     *                 @OA\Property(property="precio", type="integer", example="1"),
     *                 @OA\Property(property="disponible", type="boolean", example=true)
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return response()->json($vehiculos);
    }

    /**
     * @OA\Get(
     *     path="/rest/vehiculos/show/{id}",
     *     summary="Obtener un vehiculo por id",
     *     description="Renorna los detalles de un vehiculo",
     *     tags={"Vehiculos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del vehiculo",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del vehiculo con id seleccionado",
     *         @OA\JsonContent(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="id_marca", type="integer", example="99"),
     *                 @OA\Property(property="modelo", type="integer", example="2010"),
     *                 @OA\Property(property="precio", type="integer", example="1"),
     *                 @OA\Property(property="disponible", type="boolean", example=true)
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehiculo no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['error' => 'No existe el Vehiculo'], 404);
        }
        return response()->json($vehiculo);  
    }

    /**
     * @OA\Get(
     *     path="/rest/vehiculos/vehiculo/{marca}",
     *     summary="Buscar vehiculo por una marca",
     *     description="Retorna vehiculos",
     *     tags={"Vehiculos"},
     *     @OA\Parameter(
     *         name="marca",
     *         in="path",
     *         description="marca relacionada al vehiculo a buscar",
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
     *                 @OA\Property(property="vehiculo", type="string", maxLength=50, nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontro la marca del vehiculo",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function buscarVehiculoPorMarca($marca)
    {
        $vehiculos = Vehiculo::whereHas('marca', function ($query) use ($marca) {
            $query->where('marca', $marca);
        })->get();

        if(!$vehiculos){
            return response()->json(['error' => 'No existe la Marca'], 404);
        }
        return response()->json($vehiculos);
    }

    /**
     * @OA\Post(
     *     path="/rest/vehiculos/vehiculo/{modelo}",
     *     summary="Buscar vehiculo por modelo",
     *     description="Retorna un vehiculo",
     *     tags={"Vehiculos"},
     *     @OA\Parameter(
     *         name="modelo",
     *         in="path",
     *         description="Modelo del vehiculo a buscar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Vehiculo encontrado",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="marca", type="string"),
     *                  @OA\Property(property="modelo", type="integer"),
     *                  @OA\Property(property="precio", type="integer"),
     *                  @OA\Property(property="disponible", type="boolean")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No se encontro vehiculo",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function buscarVehiculoPorModelo(int $modelo)
    {
        $vehiculos = Vehiculo::where('modelo', $modelo)->get();
        if ($vehiculos->isEmpty()) {
            return response()->json(['error' => 'No existen vehículos para el modelo especificado'], 401);
        }
        return response()->json($vehiculos);
    }
}

?>