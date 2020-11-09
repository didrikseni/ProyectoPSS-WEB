<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIMateriaController extends Controller
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
        $carrera = auth()->user()->carrera()->first();
        $materias = $carrera->materias();
        return response(json_encode($materias), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response('Method not allowed', 405);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materia = Materia::findOrFail($id);
        return response(json_encode($materia), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Materia $materia
     * @return Response
     */
    public function update(Request $request, Materia $materia)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Materia $materia
     * @return Response
     */
    public function destroy(Materia $materia)
    {
        return response('Method not allowed', 405);
    }
}
