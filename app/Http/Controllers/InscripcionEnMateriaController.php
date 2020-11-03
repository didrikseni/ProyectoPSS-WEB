<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\InscripcionEnMateria;
use App\Models\Materia;
use App\Rules\CorrelatividadCheck;
use App\Rules\InscripcionRolAlumno;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InscripcionEnMateriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
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
        return redirect(route('materias.index'))->with('success', 'Se inscribió correctamente en la materia');
    }

    /**
     * Display the specified resource.
     *
     * @param InscripcionEnMateria $inscripcionEnMateria
     * @return Response
     */
    public function show(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InscripcionEnMateria $inscripcionEnMateria
     * @return Response
     */
    public function edit(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param InscripcionEnMateria $inscripcionEnMateria
     * @return Response
     */
    public function update(Request $request, InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InscripcionEnMateria $inscripcionEnMateria
     * @return Response
     */
    public function destroy(InscripcionEnMateria $inscripcionEnMateria)
    {
        //
    }
}
