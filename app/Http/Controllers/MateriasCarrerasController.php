<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Materia;
use App\Models\MateriasCarreras;
use App\Rules\AnioExisteEnCarrera;
use App\Rules\CarreraMateriaUnica;
use App\Rules\MateriaCarreraAsociadas;
use Illuminate\Http\Request;

class MateriasCarrerasController extends Controller
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
        return view('Carreras.carreras_materias_asociate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'materia' => 'required|exists:materias,id_str',
            'carrera' => 'required|exists:carreras,id_str',
            'cuatrimestre' => 'required|integer|gte:0|lte:1',
            'anio' => 'required|integer|gt:0'
        ]);

        request()->validate([
            'carrera' => [
                new CarreraMateriaUnica(request()->carrera, request()->materia)
            ],
            'materia' => [
                new CarreraMateriaUnica(request()->carrera, request()->materia)
            ]
        ]);

        $materia_carrera = new MateriasCarreras([
            'id_materia' => Materia::where('id_str', '=', $request->materia)->first()->id,
            'id_carrera' => Carreras::where('id_str', '=', $request->carrera)->first()->id,
            'cuatrimestre' => $request->cuatrimestre,
            'anio' => $request->anio,
        ]);
        $materia_carrera->save();
        return redirect()->back()->with('Sistema', "La materia fue asociada correctamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function show(Carreras $carreras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function edit(Carreras $carreras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carreras $carreras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carreras $carreras)
    {
        //
    }
}
