<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InscripcionEnMateria;
use App\Rules\CorrelatividadCheck;
use App\Rules\InscripcionRolAlumno;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class APIInscripcionMateriaController extends Controller
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
        try {
            $request->validate([
                'materia' => new CorrelatividadCheck(),
                'alumno' => new InscripcionRolAlumno(),
            ]);

            $inscripcion = new InscripcionEnMateria([
                'id_alumno' => auth()->user(),
                'id_materia' => $request->materia,
            ]);

            $inscripcion->save();

            return response(json_encode('Success enrolling to signature'), 200);
        } catch (ValidationException $exception) {
            return response("Error enrolling to signature", 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return response('Method not allowed', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $inscMat = InscripcionEnMateria::where('id_alumno', auth()->user()->id)
                ->where('id_materia', $id)
                ->first();

            $inscMat->delete();
            return response("Succesfully unsuscribed from signature", 200);
        } catch (QueryException $exception) {
            return response("Error unsubscribing from signature", 406);
        }


    }
}
