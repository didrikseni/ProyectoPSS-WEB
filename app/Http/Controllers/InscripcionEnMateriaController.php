<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\InscripcionEnMateria;
use Illuminate\Http\Request;

class InscripcionEnMateriaController extends Controller
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
        $carreras = auth()->user()->carrera();
        $materias = [];
        foreach ($carreras as $car) {
            $mat = $car->materias();
//            dd($mat);
            array_merge($materias, $mat);
        }
        return view('materias.materias_inscribir', compact('materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InscripcionEnMateria  $inscripcionEnMateria
     * @return \Illuminate\Http\Response
     */
    public function show(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InscripcionEnMateria  $inscripcionEnMateria
     * @return \Illuminate\Http\Response
     */
    public function edit(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InscripcionEnMateria  $inscripcionEnMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InscripcionEnMateria  $inscripcionEnMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }
}
