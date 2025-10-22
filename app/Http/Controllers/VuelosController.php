<?php

namespace App\Http\Controllers;

use App\Models\Vuelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VuelosController extends Controller
{
    public function index(Request $request)
    {
        $vuelos = Vuelos::all();

        $query = Vuelos::query();

        if ($request->has("tipo_vuelo")) {
            $tipo = $request->tipo_vuelo;
            $query->where('tipo_vuelo', $tipo);
        }

        if ($request->has('origen')) {
            $query->where('origen', $request->origen);
        }

        if ($request->has('destino')) {
            $query->where('destino', $request->destino);
        }

        $datos = $query->get();
        return response()->json([
            "data" => $datos
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'avion_id' => 'required|exists:avions,id',
                'image' => 'nullable',
                'origen' => 'required|string',
                'destino' => 'required|string',
                'fecha_salida' => 'required|date',
                'fecha_llegada' => 'required|date|after:fecha_salida',
                'tipo_vuelo' => 'required|string|in:"Solo ida","Ida y vuelta"',
                'precio' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        $vuelos = Vuelos::create([
            'avion_id' => $request->avion_id,
            'image' => $request->image,
            'origen' => $request->origen,
            'destino' => $request->destino,
            'fecha_salida' => $request->fecha_salida,
            'fecha_llegada' => $request->fecha_llegada,
            'tipo_vuelo' => $request->tipo_vuelo,
            'precio' => $request->precio,
        ]);

        return response(
            [
                'message' => "VUELO CREADO EXITOSAMENTE!",
                'data' => $vuelos
            ]
        );
    }

    public function update(Request $request, string $id)
    {
        $vuelo = Vuelos::find($id);

        if (!$vuelo) {
            return response()->json(['message' => "NO HAY VUELOS DISPONIBLES"]);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'avion_id' => 'exists:avions,id',
                'image' => 'nullable',
                'origen' => 'nullable|string',
                'destino' => 'nullable|string',
                'fecha_salida' => 'nullable|date',
                'fecha_llegada' => 'nullable|date',
                'tipo_vuelo' => 'nullable|string|in:"Solo ida","Ida y vuelta"',
                'precio' => 'nullable|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        if ($request->has('avion_id')) {
            $vuelo->avion_id = $request->avion_id;
        }

        if ($request->has('image')) {
            $vuelo->image = $request->image;
        }

        if ($request->has('origen')) {
            $vuelo->origen = $request->origen;
        }

        if ($request->has('destino')) {
            $vuelo->destino = $request->destino;
        }

        if ($request->has('fecha_salida')) {
            $vuelo->fecha_salida = $request->fecha_salida;
        }

        if ($request->has('fecha_llegada')) {
            $vuelo->fecha_llegada = $request->fecha_llegada;
        }

        if ($request->has('tipo_vuelo')) {
            $vuelo->tipo_vuelo = $request->tipo_vuelo;
        }

        if ($request->has('precio')) {
            $vuelo->precio = $request->precio;
        }

        $vuelo->save();

        return response()->json(
            [
                'message' => 'CAMBIO EXITOSO',
                'data' => $vuelo
            ]
        );
    }

    public function destroy(string $id)
    {
        $vuelo = Vuelos::find($id);

        if (!$vuelo) {
            return response()->json(['message' => "NO HAY VUELOS DISPONIBLES"]);
        }

        $vuelo->delete();

        return response()->json(['message' => 'VUELO ELIMINADO']);
    }
}
