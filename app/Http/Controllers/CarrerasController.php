<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\User;
use App\Models\Departamentos;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin')->only('create');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carreras::all();
        return view('Carreras/index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamentos::all();
        $professors = User::where('rol', '=', 'Profesor')->get();        
        return view('Carreras/create', compact('professors', 'departamentos'));
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
            'anio_inicio' => ['required', 'integer', 'digits:4'],
            'id_str' => ['required', 'string', 'max:255', 'unique:carreras'],
            'departamento_responsable' => ['required', 'string'],
            'profesor_responsable' => ['required'],
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

        $carrera = new Carreras();
        $carrera->fill([            
            'nombre' => $request->nombre,
            'anio_inicio' => $request->anio_inicio, 
            'id_str' => $request->id_str,
            'departamento_responsable' => $request->departamento_responsable, 
            'profesor_responsable' => $request->profesor_responsable,
        ]);
        
        $carrera->save();
       
        return redirect('Carreras/');
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
