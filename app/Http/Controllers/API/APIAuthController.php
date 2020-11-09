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
        $userData = [
            'nombre' => auth()->user()->nombre,
            'apellido' => auth()->user()->apellido,
            'direccion_calle' => auth()->user()->direccion_calle,
            'direccion_numero' => auth()->user()->direccion_numero,
            'numero_telefono' => auth()->user()->numero_telefono,
            'email' => auth()->user()->email,
            'escuela_secundaria' => auth()->user()->escuela_secundaria,
        ];
        return response(json_encode(['userData' => ['user' => $userData, 'access_token' => $accessToken]]), 200);
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
