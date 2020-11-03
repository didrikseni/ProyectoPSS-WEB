<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class APIUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response('Method not allowed', 405);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Display the specified resource.
     *
     * @param User $materia
     * @return Response
     */
    public function show(User $user)
    {
        return $this->index();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $usr = auth()->user();
        $user = [
            'nombre' => $usr->nombre,
            'apellido' => $usr->apellido,
            'fecha_nacimiento' => $usr->fecha_nacimiento,
            'lugar_nacimiento' => $usr->lugar_nacimiento,
            'tipo_documento' => $usr->tipo_documento,
            'DNI' => $usr->DNI,
            'direccion_calle' => $usr->direccion_calle,
            'direccion_numero' => $usr->direccion_numero,
            'numero_telefono' => $usr->numero_telefono,
            'legajo' => $usr,
            'nombre_usuario' => $usr->nombre_usuario,
            'email' => $usr->email,
            'escuela_secundaria' => $usr->escuela_secundaria,
        ];
        return response(json_encode($user), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $materia
     * @return Response
     */
    public function edit(User $user)
    {
        return response(json_encode([
            'nombre' => 'String, maximo 255 caracteres, requerido',
            'apellido' => 'String, maximo 255 caracteres, requerido',
            'direccion_calle' => 'String, maximo 255 caracteres, requerido',
            'direccion_numero' => 'Entero, requerido',
            'numero_telefono' => 'Entero, requerido',
            'escuela_secundaria' => ['required_if:rol,Alumno'],
            'email' => 'String, maximo 255 caracteres, requerido, formato de email válido',
            'password' => 'String, minimo 8 caracteres, requerido'
        ]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $materia
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $this->validateUser($request);
            $user = auth()->user();
            $user->

            $user->fill([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'direccion_calle' => $request->direccion_calle,
                'direccion_numero' => $request->direccion_numero,
                'numero_telefono' => $request->numero_telefono,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'escuela_secundaria' => $request->escuela_secundaria,
            ]);
            $user->save();
            return response('Succesfully update user information', 200);
        } catch (ValidationException $exception) {
            return response("Error updating user information", 406);
        }
    }

    private function validateUser(Request $request): array
    {
        return request()->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'direccion_calle' => ['required', 'string', 'max:255'],
            'direccion_numero' => ['required', 'integer'],
            'numero_telefono' => ['required', 'integer'],
            'escuela_secundaria' => ['required_if:rol,Alumno'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $materia
     * @return Response
     */
    public function destroy(User $user)
    {
        return response('Method not allowed', 405);
    }
}
