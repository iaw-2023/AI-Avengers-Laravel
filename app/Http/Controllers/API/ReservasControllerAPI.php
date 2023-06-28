<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\ReservaDetalles;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class ReservasControllerAPI extends Controller
{
    /**
     * @OA\Get(
     *     path="/rest/reservas",
     *     summary="Obtener lista de reservas",
     *     description="Retorna una lista de todas las reservas en la base de datos",
     *     tags={"Reservas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de reservas encontrada",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="email", type="string", maxLength=50, nullable=true, example="Email de una reserva"),
     *                 @OA\Property(property="fecha_inicio", type="string", format="date", example="18-05-2023"),
     *                 @OA\Property(property="fecha_final", type="string", format="date", example="18-05-2024")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $reservas = Reserva::all();
        return response()->json($reservas);
    }

    /**
     * @OA\Get(
     *     path="/rest/reservas/show/{id}",
     *     summary="Obtener una reserva por id",
     *     description="Renorna los detalles de una reserva",
     *     tags={"Reservas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la reserva",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la reserva con id seleccionado",
     *         @OA\JsonContent(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="email", type="string", maxLength=50, nullable=true, example="Email de la reserva")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=402,
     *         description="Reserva no encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $reserva = Reserva::find($id);
        if (!$reserva) {
            return response()->json(['error' => 'No existe la Reserva'], 404);
        }
        return response()->json($reserva);  
    }

    /**
     * @OA\Get(
     *     path="/rest/reservas/reserva/{email_cliente}",
     *     summary="Buscar reserva por email del cliente",
     *     description="Retorna una reserva",
     *     tags={"Reserva"},
     *     @OA\Parameter(
     *         name="email_cliente",
     *         in="path",
     *         description="email de la reserva a buscar",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Reserva encontrada",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="email", type="string", maxLength=50, nullable=true, example="Reserva por email")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontro la reserva",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function buscarPorMail(string $email_cliente)
    {   
        $reserva = Reserva::where('email', $email_cliente)->get();
        if (!$reserva) {
            return response()->json(['error' => 'No existe el Email'], 404);
        }
        return response()->json($reserva); 
    }

    /**
     * @OA\Get(
     *     path="/rest/reservas/reserva/{id}",
     *     summary="Mostrar los detalles de una reserva",
     *     description="Retorna los detalles de una reserva",
     *     tags={"Reserva"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id de la reserva a buscar",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la reserva encontrada",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="data", type="string", maxLength=1000, nullable=true, example="Detalles de la reserva")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontro la Reserva",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function mostrarDetalles(string $id)
    {
        $id_vehiculo = ReservaDetalles::where('id_vehiculo', $id)->get();
        $id_reserva = ReservaDetalles::where('id_reserva', $id)->get();
        $precio = ReservaDetalles::where('precio', $id)->get();
        
        if (empty($id_vehiculo) || empty($id_reserva) || empty($precio)) {
            return response()->json(['error' => 'Datos vacios'], 404);
        }
        $data = [
            'id_vehiculo' => $id_vehiculo,
            'id_reserva' => $id_reserva,
            'precio' => $precio
        ];
        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/rest/reservas/crearReserva",
     *     summary="Crear reserva",
     *     description="Crea una nueva reserva en base a un email de un cliente",
     *     tags={"Reserva"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="test@gmail.com"),
     *             @OA\Property(property="fecha_inicio", type="string", format="date", example="2023-05-18"),
     *             @OA\Property(property="fecha_final", type="string", format="date", example="2024-05-18"),
     *             @OA\Property(property="vehiculos", type="array", @OA\Items(type="integer"))
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Reserva creada correctamente",
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="mensaje", type="string")
     *     )
     * ),
     *     @OA\Response(
     *         response=400,
     *         description="Error al crear la reserva"
     *     )
     * )
     */
    public function crearReserva(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:3|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date|after:fecha_inicio',
            'vehiculos' => 'required|array',
            'vehiculos.*' => 'integer|exists:vehiculos,id', 
        ], [
            'email.required' => 'El campo email es obligatorio',
            'fecha_final.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio',
            'vehiculos.required' => 'Debe seleccionar al menos un vehículo',
            'vehiculos.array' => 'El campo vehiculos debe ser un arreglo',
            'vehiculos.*.integer' => 'Los identificadores de vehículos deben ser enteros',
            'vehiculos.*.exists' => 'Algunos de los identificadores de vehículos no existen',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $reserva = new Reserva();
        $reserva->email = $request->input('email');
        $reserva->fecha_inicio = $request->input('fecha_inicio');
        $reserva->fecha_final = $request->input('fecha_final');
        $reserva->save();

        $vehiculos = $request->input('vehiculos');
        foreach ($vehiculos as $vehiculoId) 
        {
            $vehiculo = Vehiculo::find($vehiculoId);
            if ($vehiculo) {
                $reserva->vehiculo()->attach($vehiculo);
            }
        }

        return response()->json([
            'mensaje' => 'Reserva creada correctamente',
            'id_reserva' => $reserva->id,
        ], 200);
    }
}

?>