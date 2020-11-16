<?php

namespace App\Rules;

use App\Models\Materia;
use Illuminate\Contracts\Validation\Rule;

class CorrelatividadCheck implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $materia = Materia::findOrFail($value);
        $materiasAprobadas = [];
        $notasAlumno = auth()->user()->notas();
        foreach ($notasAlumno as $nota) {
            if ($nota->aprobado()) {
                $idMat = $nota->mesaExamen()->id_materia;
                $materiasAprobadas[] = Materia::findOrFail($idMat);
            }
        }

        $materiasNecesarias = [];
        foreach ($materia->getCorrelativasFuertes() as $cfuerte) {
            $materiasNecesarias[] = $cfuerte;
        }
        foreach ($materia->getCorrelativasDebiles() as $cdebil) {
            $materiasNecesarias[] = $cdebil;
        }
        return array_diff($materiasNecesarias, $materiasAprobadas) === [];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No posee las correlativas necesarias para anotarse en esta materia.';
    }
}
