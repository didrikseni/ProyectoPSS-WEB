<?php

namespace App\Http\Controllers;

use App\Models\MesaExamen;
use App\Models\Materia;
use Illuminate\Http\Request;

class MesaExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $mesa_examen = $this->getMesasExamen();
        return view('MesaExamen/index', compact ('mesa_examen')); 
    }

    private function getMesasExamen():array {
        $user = auth()->user();
        $mesa_examen = array();
        $materia = null;
        if($user->isAdmin()){
            $mesa_examen = MesaExamen::all();
        }
        else{
            if($user->isProfessor()){
                $materias = $user->materiasProfesor();               
            }
            else{
                if($user->isStuddent()){
                    $materias = $user->materiasAlumno();
                }
            }
            foreach ($materias as $materia){
                array_merge($mesa_examen, $materia->getMesasExamen());
            }
        }
        return $mesa_examen->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_examen = MesaExamen::type_exam_options();
        $materias = Materia::all();
        return view('MesaExamen/create', compact('materias', 'tipo_examen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);
        $mesa = new MesaExamen();

        $mesa->fill([
            'id_materia' => $request->materia,
            'tipo_examen' => $request->tipo_examen,
            'fecha' => $request->fecha,
            'horario' => $request->hora,
            'observaciones' => $request->observaciones
        ]);

        $mesa->save();
        return redirect('MesaExamen/confirmation/' . $mesa->id);
    }

    
    public function confirmation($mesa_id){  
        $mesa = MesaExamen::where('id', $mesa_id)->firstOrFail();
        $materia = Materia::where('id', $mesa->id_materia)->firstOrFail();
        return view('MesaExamen/confirmation', compact('mesa', 'materia'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MesaExamen  $mesaExamen
     * @return \Illuminate\Http\Response
     */
    public function show(MesaExamen $mesaExamen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MesaExamen  $mesaExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(MesaExamen $mesaExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MesaExamen  $mesaExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MesaExamen $mesaExamen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MesaExamen  $mesaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(MesaExamen $mesaExamen)
    {
        //
    }



    private function validateData(Request $request): array {
        return request()->validate([
            'materia' => ['required'],
            'tipo_examen' =>['required'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
        ]);

    }
}