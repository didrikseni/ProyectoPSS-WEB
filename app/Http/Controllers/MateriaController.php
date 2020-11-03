<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\Materia;
use App\Models\User;
use App\Rules\MateriaProfesor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MateriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $materias = Materia::all()->sortByDesc('created_at');
        $carreras = Carreras::all()->sortBy('created_at');
        $matInfo = null;
        return view('materias.materias_search', compact('materias', 'carreras', 'matInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('materias.materias_create', ['dptos' => Departamentos::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validateMateria();
        $materia = new Materia([
            'nombre' => $request->nombre,
            'id_str' => $request->id,
            'departamento' => $request->dpto,
        ]);

        if ($request->profesor) {
            request()->validate(['profesor' => ['integer', new MateriaProfesor]]);
            $materia['id_profesor'] = User::where('legajo', '=', $request->profesor)->first()->id;
        }

        if ($request->asistente) {
            request()->validate(['asistente' => ['integer', new MateriaProfesor]]);
            $materia['id_asistente'] = User::where('legajo', '=', $request->asistente)->first()->id;
        }

        $materia->save();
        return redirect()->back()->with('Sistema', 'La materia fue cargada correctamente.');
    }

    private function validateMateria(): array
    {
        return request()->validate([
            'nombre' => 'required',
            'id' => 'required|min:1|max:5|unique:materias,id_str',
            'dpto' => 'required|exists:departamentos,id',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Materia $materia
     * @return Response
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $materia = Materia::findOrFail($id);
        $materia['id_profesor'] = User::findOrFail($materia->id_profesor)->legajo;
        $materia['id_asistente'] = User::findOrFail($materia->id_asistente)->legajo;
        $dptos = Departamentos::all();
        return view('materias.materias_edit', compact('materia', 'dptos'));
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
        $materia = Materia::findOrFail($materia->id);
        $request->validate([
            'nombre' => 'required',
            'id_str' => 'required|min:1|max:5|unique:materias,id_str',
            'departamento' => 'required|exists:departamentos,id',
        ]);
        $materia->nombre = $request->nombre;
        $materia->id_str = $request->id_str;
        $materia->departamento = $request->departamento;
        $materia->id_profesor = null;
        $materia->id_asistente = null;
        $materia->save();

        return redirect(route('materias.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Materia $materia
     * @return Response
     */
    public function destroy(Materia $materia)
    {
        $materia = Materia::findOrFail($materia->id);
        $materia->delete();
        return redirect()->route('materias.index');
    }

    public function edit_professor()
    {
        return view('materias.materias_asociate_professor');
    }

    public function update_professor(Request $request)
    {
        $materia = Materia::find(Materia::getID($request->materia));
        $request->validate([
            'materia' => 'required|exists:materias,id_str',
            'profesor' => ['required', 'integer', new MateriaProfesor],
            'asistente' => ['required', 'integer', new MateriaProfesor],
        ]);
        $materia['id_profesor'] = $request->profesor;
        $materia['id_asistente'] = $request->asistente;

        $materia->save();
        return redirect(route('materias.index'));
    }
}
