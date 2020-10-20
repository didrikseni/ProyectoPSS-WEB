<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\User;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Carreras/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professors = User::where('rol', '=', 'Profesor')->get();        
        return view('Carreras/create', compact('professors'));
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

        $carrera = new Carrera();
        
        $legajo = User::getLegajo();
        $nombre_usuario = User::getUserName($request->nombre, $request->apellido);
        
        $carrera->fill([            
            'nombre' => $request->nombre,
            'anio_inicio' => $request->anio_inicio, 
            'id_str' => $request->id_str,
            'departamento_responsable' => $request->departamento_responsable, 
            'profesor' => $request->profesor,
        ]);
        
        $carrera->save();
       
        return redirect('carreras/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function show(Carreras $carreras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function edit(Carreras $carreras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carreras $carreras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carreras $carreras)
    {
        //
    }
}
