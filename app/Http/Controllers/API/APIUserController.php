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
        return response(json_encode($this->getUserInformation($usr)), 200);
    }

    private function getUserInformation(User $user)
    {
        return [
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
            'direccion_calle' => 'String, maximo 255 caracteres, requerido',
            'direccion_numero' => 'Entero, requerido',
            'numero_telefono' => 'Entero, requerido',
            'password' => 'String, minimo 8 caracteres, requerido'
        ]), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $this->validateUser($request);
            $user = auth()->user();

            $user->direccion_calle = $request->direccion_calle ? $request->direccion_calle : $user->direccion_calle;
            $user->direccion_numero = $request->direccion_numero ? $request->direccion_numero : $user->direccion_numero;
            $user->numero_telefono = $request->numero_telefono ? $request->numero_telefono : $user->numero_telefono;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;

            $user->save();
            return response(json_encode(['Succesfully update user information', $this->getUserInformation($user)]), 200);
        } catch (ValidationException $exception) {
            return response("Error updating user information \n" . $exception->getMessage(), 406);
        }
    }

    private function validateUser(Request $request): array
    {
        return request()->validate([
            'direccion_calle' => ['string', 'max:255', 'required_without_all:direccion_numero,numero_telefono,password'],
            'direccion_numero' => ['integer','required_without_all:direccion_calle,numero_telefono,password'],
            'numero_telefono' => ['integer','required_without_all:direccion_numero,direccion_calle,password'],
            'password' => ['string', 'min:8', 'required_without_all:direccion_numero,numero_telefono,direccion_calle'],
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
