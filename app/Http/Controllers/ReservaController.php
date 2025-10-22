<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservaController extends Controller
{
    public function index()
    {
        $reserva = Reserva::all();

        return response()->json([
            "data" => $reserva
        ]);
    }

    public function reservaUser() {}

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required',
                'vuelo_id' => 'required|exists:vuelos,id',
                'asiento_id' => 'required|exists:asientos,id',
                'nombre_completo' => 'required|string',
                'tipo_documento' => 'required|exists:tipos_documentos,id',
                'documento' => 'required|min:8|max:11',
                'email' => "required|email|exists:users,email",
                'celular' => 'required|string|min:10',
                'metodo_id' => 'required|exists:metodos_pagos,id',
                'estado' => 'required|string|in:"confirmado","pendiente","cancelado"',
                'codigo' => 'required|string|unique:reservas,codigo',
                'cantidad_reserva' => 'required|numeric|min:1|max:5'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $reserva = Reserva::create(
            [
                'user_id' => $request->user_id,
                'vuelo_id' => $request->vuelo_id,
                'asiento_id' => $request->asiento_id,
                'nombre_completo' => $request->nombre_completo,
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'email' => $request->email,
                'celular' => $request->celular,
                'metodo_id' => $request->metodo_id,
                'monto' => $request->monto,
                'estado' => $request->estado,
                'codigo' => $request->codigo,
                'cantidad_reserva' => $request->cantidad_reserva,
            ]
        );

        return response()->json([
            'data' => $reserva
        ]);
    }

    public function destroy(string $id)
    {

        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'NO HAY RESERVAS']);
        }

        $reserva->delete();

        return response()->json(['message' => 'RESERVA CANCELADA']);
    }
}
