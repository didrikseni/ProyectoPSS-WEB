<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\materia_correlativa;
use App\Rules\CorrelativasCirculares;
use App\Rules\CorrelativaUnica;
use App\Rules\MateriaAsociadaACarrera;
use App\Rules\MateriaPosteriorACorrelativa;
use App\Rules\MateriasMismaCarrera;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MateriaCorrelativaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
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
    public function create()
    {
        return view('materias.materias_asociate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validateMateriaCorrelativa();
        $this->validateCustomRules();
        $materia_correlativa = new materia_correlativa([
            'id_materia' => Materia::where('id_str', '=', $request->get('materia'))->first()->id,
            'id_correlativa' => Materia::where('id_str', '=', $request->get('correlativa'))->first()->id,
            'tipo' => $request->get('tipo'),
        ]);
        $materia_correlativa->save();
        return redirect(route('materias.index'))->with('success', "La correlativa fue cargada correctamente.");
    }

    private function validateMateriaCorrelativa()
    {
        return request()->validate([
            'materia' => 'required|exists:materias,id_str|different:correlativa',
            'correlativa' => 'required|exists:materias,id_str|different:materia',
            'tipo' => 'required|digits_between:0,1',
        ]);
    }

    private function validateCustomRules()
    {
        return request()->validate([
            'materia' => [
                new CorrelativasCirculares(request()->get('materia'), request()->get('correlativa')),
                new CorrelativaUnica(request()->get('materia'), request()->get('correlativa')),
                new MateriaAsociadaACarrera(),
                new MateriasMismaCarrera(request()->materia, request()->correlativa),
                new MateriaPosteriorACorrelativa(request()->materia, request()->correlativa),
            ],
            'correlativa' => [
                new CorrelativasCirculares(request()->get('correlativa'), request()->get('materia')),
                new CorrelativaUnica(request()->get('materia'), request()->get('correlativa')),
                new MateriaAsociadaACarrera(),
                new MateriasMismaCarrera(request()->materia, request()->correlativa),
                new MateriaPosteriorACorrelativa(request()->materia, request()->correlativa),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param materia_correlativa $materia_correlativa
     * @return Response
     */
    public function show(materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param materia_correlativa $materia_correlativa
     * @return Response
     */
    public function edit(materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param materia_correlativa $materia_correlativa
     * @return Response
     */
    public function update(Request $request, materia_correlativa $materia_correlativa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param materia_correlativa $materia_correlativa
     * @return Response
     */
    public function destroy(materia_correlativa $materia_correlativa)
    {
        //
    }

    public function indexCorrelativasDebiles(int $id) {
        $materia = Materia::findOrFail($id);
        $tipo = 'debiles';
        $correlativas = $materia->getCorrelativasDebiles();

        return view('materias.correlativas', compact('materia', 'tipo', 'correlativas'));
    }

    public function indexCorrelativasFuertes(int $id) {
        $materia = Materia::findOrFail($id);
        $tipo = 'debiles';
        $correlativas = $materia->getCorrelativasFuertes();

        return view('materias.correlativas', compact('materia', 'tipo', 'correlativas'));
    }


}
