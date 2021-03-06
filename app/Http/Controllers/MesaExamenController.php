<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\MesaExamen;
use App\Models\IncriptoEnMesaExamen;
use App\Rules\CorrelatividadCheck;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Auth;


class MesaExamenController extends Controller
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
        $mesa_examen = $this->getMesasExamen();
        return view('MesaExamen/index', compact('mesa_examen'));
    }

    private function getMesasExamen()
    {
        $user = auth()->user();
        $mesa_examen = array();
        if ($user->isAdmin()) {
            $mesa_examen = MesaExamen::all();
        } else {
            if ($user->isProfessor()) {
                $mesa_examen = $user->mesasExamenProfesor();
            } else {
                if ($user->isStudent()) {
                    $mesa_examen = $user->mesasExamenAlumnoCarrera();
                }
            }
        }
        return $mesa_examen;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
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
            'observaciones' => $request->observaciones,
        ]);

        $mesa->save();
        return redirect('MesaExamen/confirmation/' . $mesa->id);
    }

    private function validateData(Request $request): array
    {
        return request()->validate([
            'materia' => ['required'],
            'tipo_examen' => ['required'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'observaciones' => ['nullable'],
        ]);

    }

    public function confirmation($mesa_id)
    {
        $mesa = MesaExamen::where('id', $mesa_id)->firstOrFail();
        $materia = Materia::where('id', $mesa->id_materia)->firstOrFail();
        return view('MesaExamen/confirmation', compact('mesa', 'materia'));
    }

    /**
     * Display the specified resource.
     *
     * @param MesaExamen $mesaExamen
     * @return Response
     */
    public function show(MesaExamen $mesaExamen)
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
        $mesa = MesaExamen::findOrFail($id);
        $tipo_examen = MesaExamen::type_exam_options();
        $materias = Materia::all();
        return view('MesaExamen.edit', compact('materias', 'tipo_examen', 'mesa'));
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
        $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'observaciones' => ['nullable'],
        ]);
        $mesa = MesaExamen::findOrFail($id);
        $mesa->fill([
            'fecha' => $request->fecha,
            'horario' => $request->hora,
            'observaciones' => $request->observaciones,
        ]);

        $mesa->save();
        return redirect('MesaExamen/confirmation/' . $mesa->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MesaExamen $mesaExamen
     * @return Response
     */
    public function destroy(int $id)
    {
        $mesa = MesaExamen::findOrFail($id);
        $mesa->delete();
        return redirect()->route('MesaExamen.index')->with('success', 'La mesa de examen fue eliminada correctamente.');
    }

    public function inscripcion($mesa_id){
        $mesa_examen = MesaExamen::where('id', $mesa_id)->firstOrFail();
        $materia = Materia::where('id','=', $mesa_examen->id_materia)->firstOrFail();

        // $this->validate([
        //     'materia' => new CorrelatividadCheck(),
        // ]);

        $inscripcion = new IncriptoEnMesaExamen([
            'id_mesa_examen' => $mesa_id,
            'id_alumno' => Auth::id(),
        ]);

        $inscripcion->save();
        return redirect()->back()->with('success', 'Se ha inscripto correctamente a la mesa de examen.');
    }

    //Probar si funciona, solo lo hice.
    public function desinscripcion($mesa_id){
        $mesa_examen = IncriptoEnMesaExamen::where('id_mesa_examen', $mesa_id)->where('id_alumno', Auth::id())->firstOrFail();
        $mesa_examen->delete();
        return redirect()->back()->with('error', 'Se ha desincripto correctamente de la mesa de examen');
    }

}
