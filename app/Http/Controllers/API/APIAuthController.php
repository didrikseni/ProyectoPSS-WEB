<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class APIAuthController extends Controller
{
    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $user = auth()->user();
        $userData = [
            'id' => $user->id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'lugar_nacimiento' => $user->lugar_nacimiento,
            'tipo_documento' => $user->tipo_documento,
            'DNI' => $user->DNI,
            'direccion_calle' => $user->direccion_calle,
            'direccion_numero' => $user->direccion_numero,
            'numero_telefono' => $user->numero_telefono,
            'legajo' => $user->legajo,
            'nombre_usuario' => $user->nombre_usuario,
            'email' => $user->email,
            'escuela_secundaria' => $user->escuela_secundaria,
        ];
        return response(json_encode(['status_code' => 200, 'user' => $userData, 'access_token' => $accessToken]), 200);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function isLoggedIn(Request $request) {
        if (Auth::guard('api')->check()) {
            return response()->json(['logged_in' => true], 200);
        } else {
            return response()->json(['logged_in' => false], 418);
        }
    }
}
