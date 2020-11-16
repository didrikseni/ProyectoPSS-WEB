<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\MesaExamen;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\InscripcionAlumnoMateria;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $notasCursadas = Nota::all();
        $notasFinales = Nota::all();
        if($user->isStudent()){
            $notasCursadas = $user->notasCursada();
            $notasFinales = $user->notasFinales();
        }
        return view('Nota/index', compact ('notasFinales', 'notasCursadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $tipo_examen = MesaExamen::type_exam_options();
        $materias = Materia::where('id_profesor', auth()->user()->id)->get();
        $nota = new Nota();
        return view('Nota/create', compact('materias', 'tipo_examen', 'nota'));
    }

    public function createFinal(){
        $tipo_examen = MesaExamen::type_exam_options();
        $materias = Materia::all();
        $nota = new Nota();
        return view('Nota/create', compact('materias', 'tipo_examen', 'nota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateDataCursada($request);
        $nota = new Nota();

        $nota->fill([
            'calificacionCursada' => $request->calificacion,
            'id_alumno' => $request->LU_alumno,
            'id_materia'=>$request->materia
        ]);
        
        $nota->save();
        
        return redirect()->back()->with('success', 'La nota de cursada se cargo correctamente.');
    }

    public function confirmation($mesa_id){
        $mesa = MesaExamen::where('id', $mesa_id)->firstOrFail();
        $materia = Materia::where('id', $mesa->id_materia)->firstOrFail();
        return view('MesaExamen/confirmation', compact('mesa', 'materia'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(int $nota_id)
    {
//        $nota = MesaExamen::findOrFail($nota_id);
//        $tipo_examen = MesaExamen::type_exam_options();
//        $materias = Materia::all();
//        return view('MesaExamen.edit', compact('materias', 'tipo_examen', 'mesa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota_id)
    {
        $nota = MesaExamen::findOrFail($nota_id);
        $nota->delete();
        return redirect()->route('Nota.index');
    }

    private function validateDataCursada(Request $request): array {
        return request()->validate([
            'calificacion' => ['required'],
            'LU_alumno' =>['required', new InscripcionAlumnoMateria($request->materia)],
            'materia' => ['required']
        ]);

    }
}
