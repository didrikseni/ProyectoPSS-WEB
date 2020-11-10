<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Materia;
use App\Models\MateriasCarreras;
use App\Rules\MesaExamenCheck;
use App\Models\IncriptoEnMesaExamen;
use Illuminate\Http\Request;

class IncriptoEnMesaExamenController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
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

        $request->validate([
            'mesa_examen' => new MesaExamenCheck(),
        ]);

        $inscripcion = new InscripcionEnMesaExamen([
            'id_alumno' => auth()->user()->id,
            'id_mesa_examen' => $request->mesa_examen,
        ]);

        $inscripcion->save();
        return redirect(route('MesaExamen.index'))->with('success', 'Se inscribió correctamente en la mesa de examen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncriptoEnMesaExamen  $incriptoEnMesaExamen
     * @return \Illuminate\Http\Response
     */
    public function show(IncriptoEnMesaExamen $incriptoEnMesaExamen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncriptoEnMesaExamen  $incriptoEnMesaExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(IncriptoEnMesaExamen $incriptoEnMesaExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncriptoEnMesaExamen  $incriptoEnMesaExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncriptoEnMesaExamen $incriptoEnMesaExamen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncriptoEnMesaExamen  $incriptoEnMesaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncriptoEnMesaExamen $incriptoEnMesaExamen)
    {
        //
    }
}
