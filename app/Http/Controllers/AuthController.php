<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'rol_id' => 'required|exists:rols,id',
                'name' => 'required|string|min:3',
                'primer_apellido' => 'required|string|min:3',
                'segundo_apellido' => 'required|string|min:3',
                'fecha_nacimiento' => 'required|date',
                'genero' => 'required|string',
                'tipo_documento' => 'required|exists:tipos_documento',
                'documento' => 'required|string',
                'edad' => 'required|number|min:3|max:98',
                'celular' => 'required|number|min:11',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
    }
}
