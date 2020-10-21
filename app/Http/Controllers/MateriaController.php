<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\Materia;
use App\Models\User;
use App\Rules\MateriaProfesor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materias.materias_create', ['dptos' => Departamentos::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateMateria();
        $materia = new Materia([
            'nombre' => $request->get('nombre'),
            'id_str' => $request->get('id'),
            'departamento' => $request->get('dpto'),
            'id_profesor' =>  User::where('legajo', '=', $request->get('profesor'))->first()->id,
            'id_asistente' =>  User::where('legajo', '=', $request->get('asistente'))->first()->id
        ]);
        $materia->save();
        return redirect()->back()->with('Sistema', 'La materia fue cargada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        //
    }


    public function search() {
        $materias = Materia::all()->sortByDesc('created_at');
        $carreras = Carreras::all()->sortBy('created_at');
        $matInfo = null;
        return view('materias.materias_search', compact('materias', 'carreras', 'matInfo'));
    }


    private function validateMateria(): array {
        $rules = [
            'nombre' => 'required',
            'id' => 'required|min:1|max:5|unique:materias,id_str',
            'dpto' => 'required|exists:departamentos,id',
            'profesor' => ['required', 'integer', new MateriaProfesor],
            'asistente' => ['required', 'integer', new MateriaProfesor]
        ];

        $messages = [
            'required' => 'El atributo es obligatorio',
            'string' => 'El atributo tiene que ser de tipo alfanumérico',
            'min' => 'El atributo tiene que tener un mínimo de :min caracteres',
            'max' => 'El atributo tiene que tener un máximo de :max caracteres',
            'integer' => 'El atributo tiene que ser de tipo numérico',
            'unique' => 'El identificador tiene que ser único para cada materia, actualmente hay una materia con este identificador'
        ];

        return $this->validate(request(), $rules, $messages);
    }
}
