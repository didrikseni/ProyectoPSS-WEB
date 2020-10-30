<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\InscripcionEnMateria;
use App\Models\Materia;
use App\Rules\CorrelatividadCheck;
use App\Rules\InscripcionRolAlumno;
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
    public function create()        //        Ni en pedo haría algo asi en producción... falta banda de optimización, se podría hacer con una sola query.
    {
        $carreras = auth()->user()->carrera();
        $materiasTotales = [];
        foreach ($carreras as $car) {
            $mat = Carreras::findOrFail($car->id)->materias();
            foreach ($mat as $m) {
                if ($m->id_profesor !== null) {
                    $materiasTotales[] = $m;
                }
            }
        }

        $materiasAprobadas = [];
        $notasAlumno = auth()->user()->notas();
        foreach ($notasAlumno as $nota) {
            $idMat = $nota->mesaExamen()->id_materia;
            $materiasAprobadas[] = Materia::findOrFail($idMat);
        }
         $materias = array_diff($materiasTotales, $materiasAprobadas);
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
        $request->validate([
            'materia' => new CorrelatividadCheck(),
            'alumno' => new InscripcionRolAlumno(),
        ]);

        $inscripcion = new InscripcionEnMateria([
            'id_alumno' => $request->alumno,
            'id_materia' => $request->materia,
        ]);

        $inscripcion->save();
        return redirect(route('materias.index'));
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
