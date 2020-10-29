<?php

namespace App\Rules;

use App\Models\Materia;
use App\Models\MateriasCarreras;
use Illuminate\Contracts\Validation\Rule;

class MateriaAsociadaACarrera implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return MateriasCarreras::where('id_materia', Materia::getID($value))->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La materia debe estar asociada a una carrera.';
    }
}
