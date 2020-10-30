<?php

namespace App\Rules;

use App\Models\Materia;
use Illuminate\Contracts\Validation\Rule;

class CorrelatividadCheck implements Rule
{
    private $alumno;
    private $materia;

    /**
     * Create a new rule instance.
     * @param String $alumno
     * @param String $materia
     * @return void
     */
    public function __construct(string $alumno, string $materia)
    {
      $this->alumno = $alumno;
      $this->materia = $materia;
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

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
