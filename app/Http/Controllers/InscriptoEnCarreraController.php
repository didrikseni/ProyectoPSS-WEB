<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\InscriptoEnCarrera;
use App\Models\User;
use App\Rules\InscripcionRolAlumno;
use Illuminate\Http\Request;

class InscriptoEnCarreraController extends Controller
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
        $carreras = Carreras::all()->sortByDesc('nombre');
        return view('Carreras.carreras_inscribir', compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idAlumno = User::getID($request->alumno);
        $request->validate([
            'carrera' => 'required|exists:carreras,id|unique:inscripto_en_carreras,id_carrera,NULL,NULL,id_alumno,'.$idAlumno,
            'alumno' => 'required|exists:users,legajo|unique:inscripto_en_carreras,id_alumno,NULL,NULL,id_carrera,'.$request->carrera,
        ]);

        $request->validate([
            'alumno' => new InscripcionRolAlumno(),
        ]);

        $inscripcion = new InscriptoEnCarrera([
            'id_alumno' => $request->alumno,
            'id_carrera'=> $request->carrera,
        ]);

        $inscripcion->save();

        return redirect(route('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InscriptoEnCarrera  $inscriptoEnCarrera
     * @return \Illuminate\Http\Response
     */
    public function show(InscriptoEnCarrera $inscriptoEnCarrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InscriptoEnCarrera  $inscriptoEnCarrera
     * @return \Illuminate\Http\Response
     */
    public function edit(InscriptoEnCarrera $inscriptoEnCarrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InscriptoEnCarrera  $inscriptoEnCarrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscriptoEnCarrera $inscriptoEnCarrera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InscriptoEnCarrera  $inscriptoEnCarrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(InscriptoEnCarrera $inscriptoEnCarrera)
    {
        //
    }
}
