<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\MesaExamen;
use App\Models\Nota;
use App\Models\User;
use App\Notifications\NotificacionNotas;
use App\Rules\InscripcionAlumnoMateria;
use App\Rules\InscriptoMesaExamen;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = auth()->user();
        $notas = Nota::all();
        if ($user->isStudent()) {
            $notas = $user->notasAlumno();
        }
        return view('Nota/index', compact('notas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $tipo_examen = MesaExamen::type_exam_options();
        $materias = Materia::where('id_profesor', auth()->user()->id)->get();
        $nota = new Nota();
        return view('Nota.create', compact('materias', 'tipo_examen', 'nota'));
    }

    public function createFinal()
    {
        $tipo_examen = MesaExamen::type_exam_options();
        $mesaExamen = MesaExamen::join('materias', 'materias.id', '=', 'mesa_examens.id_materia')
            ->join('users', 'users.id', '=', 'materias.id_profesor')
            ->where('users.id', auth()->user()->id)->get();
        $nota = new Nota();
        return view('Nota.createFinal', compact('mesaExamen', 'tipo_examen', 'nota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateDataCursada($request);
        $nota = new Nota();

        $nota->fill([
            'calificacionCursada' => $request->calificacion,
            'id_alumno' => $request->LU_alumno,
            'id_materia' => $request->materia
        ]);
        $nota->save();
        $alumno = User::findOrFail($request->LU_alumno);
        $alumno->notify(new NotificacionNotas());

        return redirect()->back()->with('success', 'La nota de cursada se cargo correctamente.');
    }

    private function validateDataCursada(Request $request): array
    {
        return request()->validate([
            'calificacion' => ['required'],
            'LU_alumno' => ['required', new InscripcionAlumnoMateria($request->materia)],
            'materia' => ['required']
        ]);

    }

    public function storeFinal(Request $request)
    {
        $this->validateDataFinal($request);
        $nota = new Nota();

        $nota->fill([
            'calificacionFinal' => $request->calificacion,
            'id_alumno' => $request->LU_alumno,
            'id_mesa_examen' => $request->mesaExamen
        ]);
        $nota->save();
        $alumno = User::findOrFail($request->LU_alumno);
        $alumno->notify(new NotificacionNotas());

        return redirect()->back()->with('success', 'La nota de cursada se cargo correctamente.');
    }

    private function validateDataFinal(Request $request)
    {
        $materia = MesaExamen::findOrFail($request->mesaExamen)->materia();
        return request()->validate([
            'calificacion' => ['required'],
            'LU_alumno' => ['required', new InscriptoMesaExamen($request->mesaExamen)],
            'mesaExamen' => ['required']
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
     * @param Nota $nota
     * @return Response
     */
    public function show(Nota $nota)
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
        $nota = Nota::findOrFail($id);
        $tipo = $nota->esFinal() ? 'final' : 'cursada';

        return view('Nota.edit', compact('tipo', 'nota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Nota $nota
     * @return void
     */
    public function update(Request $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Nota $nota
     * @return Response
     */
    public function destroy(Nota $nota_id)
    {
        $nota = MesaExamen::findOrFail($nota_id);
        $nota->delete();
        return redirect()->route('Nota.index');
    }
}
