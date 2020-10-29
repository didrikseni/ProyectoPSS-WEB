<?php

namespace App\Rules;

use App\Models\Materia;
use App\Models\materia_correlativa;
use App\Models\MateriasCarreras;
use Illuminate\Contracts\Validation\Rule;

class MateriaPosteriorACorrelativa implements Rule
{
    private $materia;
    private $correlativa;
    private $materiaID;
    private $correlativaID;

    /**
     * Create a new rule instance.
     * @param String $param1
     * @param String $param2
     * @return void
     */
    public function __construct(string $param1, string $param2)
    {
        $this->materiaID = $param1;
        $this->correlativaID = $param2;

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
        $mc = MateriasCarreras::where('id_materia', $this->materia)->first();
        $cc = MateriasCarreras::where('id_materia', $this->correlativa)->first();
        return ($cc->anio < $mc->anio) || ($cc->anio === $mc->anio && $cc->cuatrimestre === 0 && $mc->cuatrimestre === 1);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La materia "' . $this->correlativaID . '" debe dictarse antes que la materia "' . $this->materiaID . '".';
    }
}
