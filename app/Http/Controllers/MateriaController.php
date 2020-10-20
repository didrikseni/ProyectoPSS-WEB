<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('materias.materias_create', ['dptos' => Departamentos::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'id_profesor' =>  $request->get('profesor'),
            'id_asistente' =>  $request->get('asistente')
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
        return view('materias.materias_search', Carreras::all());
    }


    private function validateMateria(): array {
        return request()->validate([
            'nombre' => 'required',
            'id' => 'required|min:1|max:5|unique:materias,id_str',
            'dpto' => 'required|exists:departamentos,id',
            'profesor' => ['required', Rule::exists('users', 'legajo')->where('rol', 'Profesor')],
            'asistente' => ['required', Rule::exists('users', 'legajo')->where('rol', 'Profesor')],
        ]);
    }
}
