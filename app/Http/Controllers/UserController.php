<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $users = User::all();
        return view('User/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $user = new User();
        return view('User/create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $this->validateUser($request);
        $user = new User();

        $legajo = User::getLegajo();
        $nombre_usuario = User::getUserName($request->nombre, $request->apellido);

        $user->fill([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'tipo_documento' => $request->tipo_documento,
            'DNI' => $request->DNI,
            'direccion_calle' => $request->direccion_calle,
            'direccion_numero' => $request->direccion_numero,
            'numero_telefono' => $request->numero_telefono,
            'legajo' => $legajo,
            'nombre_usuario' => '$nombre_usuario',
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'escuela_secundaria' => $request->escuela_secundaria,
        ]);

        $user->nombre_usuario = $nombre_usuario;
        $user->save();

        return redirect('User/confirmation/' . $user->DNI);
    }

    private function validateUser(Request $request): array
    {
        return request()->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'lugar_nacimiento' => ['required', 'string', 'max:255'],
            'tipo_documento' => ['required'],
            'DNI' => ['required', 'integer', 'digits_between:1,12', 'unique:users'],
            'direccion_calle' => ['required', 'string', 'max:255'],
            'direccion_numero' => ['required', 'integer'],
            'numero_telefono' => ['required', 'integer'],
            'rol' => ['required'],
            'escuela_secundaria' => ['required_if:rol,Alumno'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

    }

    public function confirmation($user_dni)
    {
        $user = User::where('DNI', $user_dni)->firstOrFail();
        return view('User/confirmation', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'lugar_nacimiento' => ['required', 'string', 'max:255'],
            'tipo_documento' => ['required'],
            'DNI' => ['required', 'integer', 'digits_between:1,12', 'unique:users,DNI,' . $user->id . ',id'],
            'direccion_calle' => ['required', 'string', 'max:255'],
            'direccion_numero' => ['required', 'integer'],
            'numero_telefono' => ['required', 'integer'],
            'rol' => ['required'],
            'escuela_secundaria' => ['required_if:rol,Alumno'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id . ',id'],
        ]);
        $user->nombre = $request->nombre ?? $user->nombre;
        $user->apellido = $request->apellido ?? $user->apellido;
        $user->fecha_nacimiento = $request->fecha_nacimiento ?? $user->fecha_nacimiento;
        $user->lugar_nacimiento = $request->lugar_nacimiento ?? $user->lugar_nacimiento;
        $user->tipo_documento = $request->tipo_documento ?? $user->tipo_documento;
        $user->DNI = $request->DNI ?? $user->DNI;
        $user->direccion_calle = $request->direccion_calle;
        $user->direccion_numero = $request->direccion_numero;
        $user->numero_telefono = $request->numero_telefono;
        $user->rol = $request->rol ?? $user->rol;
        $user->escuela_secundaria = $request->escuela_secundaria;
        $user->save();

        return redirect('/')->with('success', 'El usuario se modificó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {

    }

}
