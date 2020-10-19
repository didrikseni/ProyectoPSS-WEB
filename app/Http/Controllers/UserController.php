<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{

    public function __construct(){
        // $this->middleware('admin')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('User/index', compact ('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('User/create', compact ('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' =>['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'lugar_nacimiento' => ['required', 'string', 'max:255'],
            'DNI' => ['required', 'integer', 'digits:8', 'unique:users'],
            'direccion_calle' => ['required', 'string', 'max:255'],
            'direccion_numero'=> ['required', 'integer'],
            'numero_telefono' => ['required', 'integer'],
            'rol' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']          
        ];

        $messages = [
            'required' => 'El atributo es obligatorio',
            'string' => 'El atributo tiene que ser de tipo alfanumérico',
            'min' => 'El atributo tiene que tener un mínimo de :min caracteres',
            'digits' => 'El atributo tiene que tener un tamaño de :digits caracteres',
            'integer' => 'El atributo tiene que ser de tipo numérico',
            'unique' => 'El atributo tiene que ser único para cada usuario, actualmente hay un usuario con estos datos'
        ];
        
       $this->validate(request(), $rules, $messages);       

        $user = new User();
        
        $legajo = User::getLegajo();
        $nombre_usuario = User::getUserName($request->nombre, $request->apellido);
        
        $user->fill([            
            'nombre' => $request->nombre,
            'apellido' => $request->apellido, 
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'lugar_nacimiento' => $request->lugar_nacimiento, 
            'DNI' => $request->DNI,
            'direccion_calle' => $request->direccion_calle,
            'direccion_numero' => $request->direccion_numero,
            'numero_telefono' => $request->numero_telefono,
            'legajo' => $legajo,
            'nombre_usuario' => '$nombre_usuario',
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make( $request->password),
            'escuela_secundaria' => 'asdasd',
        ]);
        
        $user->nombre_usuario = $nombre_usuario;
        $user->save();
       
        return redirect('User/confirmation/' . $user->DNI);
    }

    public function confirmation($user_dni){
        $user = User::where('DNI', $user_dni)->firstOrFail();
        return view('User/confirmation', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}
