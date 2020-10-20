<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\materia_correlativa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MateriaCorrelativaController extends Controller
{
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
        return view('materias.materias_asociate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateMateriaCorrelativa();
        $materia_correlativa = new materia_correlativa([
            'id_materia' => Materia::where('id_str', '=', $request->get('materia'))->first()->id,
            'id_correlativa' => Materia::where('id_str', '=', $request->get('correlativa'))->first()->id,
            'tipo' => $request->get('tipo'),
        ]);
        $materia_correlativa->save();
        return redirect()->back()->with('Sistema', "La correlativa fue cargada correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\materia_correlativa $materia_correlativa
     * @return \Illuminate\Http\Response
     */
    public function show(materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\materia_correlativa $materia_correlativa
     * @return \Illuminate\Http\Response
     */
    public function edit(materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\materia_correlativa $materia_correlativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\materia_correlativa $materia_correlativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(materia_correlativa $materia_correlativa)
    {
        //
    }

    private function validateMateriaCorrelativa()
    {
        return request()->validate([
            'materia' => 'required|exists:materias,id_str',
            'correlativa' => 'required|exists:materias,id_str',
            'tipo' => 'required|digits_between:0,1',
        ]);
    }
}
