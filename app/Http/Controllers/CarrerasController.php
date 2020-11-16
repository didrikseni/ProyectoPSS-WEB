<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CarrerasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only('create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $carreras = Carreras::all();
        return view('Carreras/index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $departamentos = Departamentos::all();
        $professors = User::where('rol', '=', 'Profesor')->get();
        return view('Carreras/create', compact('professors', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:255'],
            'anio_inicio' => ['required', 'integer', 'digits:4'],
            'id_str' => ['required', 'string', 'max:255', 'unique:carreras'],
            'departamento_responsable' => ['required', 'string'],
            'profesor_responsable' => ['required'],
        ];

        $messages = [
            'required' => 'El atributo es obligatorio',
            'string' => 'El atributo tiene que ser de tipo alfanumérico',
            'min' => 'El atributo tiene que tener un mínimo de :min caracteres',
            'digits' => 'El atributo tiene que tener un tamaño de :digits caracteres',
            'integer' => 'El atributo tiene que ser de tipo numérico',
            'unique' => 'El atributo tiene que ser único para cada usuario, actualmente hay un usuario con estos datos'
        ];

        $this->validate(request(), $rules, $messages);

        $carrera = new Carreras();
        $carrera->fill([
            'nombre' => $request->nombre,
            'anio_inicio' => $request->anio_inicio,
            'id_str' => $request->id_str,
            'departamento_responsable' => $request->departamento_responsable,
            'profesor_responsable' => $request->profesor_responsable,
        ]);

        $carrera->save();

        return redirect('Carreras/')->with('success', 'La carrera fue cargada correctamente en el sistema.');
    }

    /**
     * Display the specified resource.
     *
     * @param Carreras $carreras
     * @return Response
     */
    public function show(Carreras $carreras)
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
        $carrera = Carreras::findOrFail($id);
        $carrera['departamento_responsable'] = Departamentos::findOrFail($carrera->departamento_responsable)->nombre;
        $carrera['profesor_responsable'] = User::findOrFail($carrera->profesor_responsable)->legajo;
        $professors = User::where('rol', '=', 'Profesor')->get();
        $dptos = Departamentos::all();
        return view('Carreras.carreras_edit', compact('carrera', 'dptos', 'professors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, int $id)
    {
        $carrera = Carreras::findOrFail($id);
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'anio_inicio' => ['required', 'integer', 'digits:4'],
            'id_str' => ['required', 'string', 'max:255', 'unique:carreras,id_str,' . $carrera->id . ',id'],
            'departamento_responsable' => ['string', 'exists:departamentos,id'],
            'profesor_responsable' => ['exists:users,legajo'],
        ]);
        $carrera->nombre = $request->nombre;
        $carrera->anio_inicio = $request->anio_inicio;
        $carrera->id_str = $request->id_str;
        $carrera->departamento_responsable = $request->departamento_responsable ?? $carrera->departamento_responsable;
        $carrera->profesor_responsable = $request->profesor_responsable ?? $carrera->profesor_responsable;
        $carrera->save();

        return redirect(route('Carreras.index'))->with('success', 'La carrera se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $carrera = Carreras::findOrFail($id);
        $carrera->delete();
        return redirect()->route('Carreras.index')->with('success', 'La carrera fue eliminada correctamente.');
    }


    public function showMaterias(int $id) {
        $carrera = Carreras::findOrFail($id);
        $materias = $carrera->materias();
        return view('Carreras.materias', compact('materias', 'carrera'));
    }
}
