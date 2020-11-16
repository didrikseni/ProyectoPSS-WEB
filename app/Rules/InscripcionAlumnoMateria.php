<?php

namespace App\Rules;

use App\Models\Materia;
use App\Models\InscripcionEnMateria;
use Illuminate\Contracts\Validation\Rule;

class InscripcionAlumnoMateria implements Rule
{

    private $materia;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $param1)
    {
        $this->materia = Materia::firstOrFail('id', $param1);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return InscripcionEnMateria::where('id_materia', '=', $this->materia->id)->where('id_alumno', '=', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El usuario ingresado no esta incripto en la materia.';
    }
}
