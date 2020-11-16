<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\Materia;
use App\Models\User;
use App\Rules\MateriaProfesor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

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
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $mat = Materia::all()->sortByDesc('created_at');
        $carreras = Carreras::all()->sortBy('created_at');
        $matInfo = null;
        $materias = [];
        foreach ($mat as $materia) {
            $materias[] = [
                'id' => $materia->id,
                'id_str' => $materia->id_str,
                'nombre' => $materia->nombre,
                'departamento' => $materia->departamento,
                'id_profesor' => $materia->id_profesor,
                'id_asistente' => $materia->id_asistente,
                'anio' => $materia->asociadaACarrera() ? $materia->getAnio() : 'No asociada',
                'cuatrimestre' => $materia->asociadaACarrera() ? ($materia->getCuatrimestre() === 0 ? 'primero' : 'segundo') : 'No asociada',
            ];
        }

        return view('materias.materias_index', compact('materias', 'carreras', 'matInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('materias.materias_create', ['dptos' => Departamentos::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
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
        return redirect()->back()->with('success', 'La materia fue cargada correctamente.');
    }

    private function validateMateria(): array
    {
        return request()->validate([
            'nombre' => 'required',
            'id' => 'required|min:1|max:255|unique:materias,id_str',
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
     * @return Application|Factory|View|Response
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
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Materia $materia)
    {
        // dd($request->nombre, $request->id_str, $request->departamento, $request->profesor, $request->asistente);
        $materia = Materia::findOrFail($materia->id);
        $request->validate([
            'nombre' => 'required',
            'id_str' => 'required|min:1|max:255|unique:materias,id_str,' . $materia->id . ',id',
            'departamento' => 'required|exists:departamentos,id',
            'profesor' => ['integer', new MateriaProfesor],
            'asistente' => ['integer', new MateriaProfesor],
        ]);
        $materia->nombre = $request->nombre;
        $materia->id_str = $request->id_str;
        $materia->departamento = $request->departamento;
        $materia->id_profesor = $request->profesor ? $request->profesor : $materia->id_profesor;
        $materia->id_asistente = $request->asistente ? $request->asistente : $materia->id_asistente;
        $materia->save();

        return redirect(route('materias.index'))->with('success', 'La materia fue editada correctamente.');
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
        return redirect()->route('materias.index')->with('success', 'La materia se ha eliminado correctamente.');
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
        return redirect(route('materias.index'))->with('success', 'El profesor se ha actualizado correctamente.');
    }
}
