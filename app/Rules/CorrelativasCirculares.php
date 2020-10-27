<?php

namespace App\Rules;

use App\Models\Materia;
use App\Models\materia_correlativa;
use Illuminate\Contracts\Validation\Rule;

class CorrelativasCirculares implements Rule
{
    private $materia;
    private $correlativa;

    /**
     * Create a new rule instance.
     * @param String $param1
     * @param String $param2
     * @return void
     */
    public function __construct(string $param1, string $param2)
    {
        $this->materia = Materia::getID($param1);
        $this->correlativa = Materia::getID($param2);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cond1 = materia_correlativa::where('id_materia', '=', $this->correlativa)->where('id_correlativa', '=', $this->materia)->exists();
        $cond2 = materia_correlativa::where('id_materia', '=', $this->materia)->where('id_correlativa', '=', $this->correlativa)->exists();

        return !$cond1 && !$cond2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Estas materias ya son correlativas.';
    }
}
