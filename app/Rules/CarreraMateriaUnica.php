<?php

namespace App\Rules;

use App\Models\Carreras;
use App\Models\Materia;
use App\Models\MateriasCarreras;
use Illuminate\Contracts\Validation\Rule;

class CarreraMateriaUnica implements Rule
{
    private $materia;
    private $carrera;
    private $materiaID;
    private $carreraID;

    /**
     * Create a new rule instance.
     * @param String $param1
     * @param String $param2
     * @return void
     */
    public function __construct(string $param1, string $param2)
    {
        $this->materiaID = $param2;
        $this->carreraID = $param1;

        $this->materia = Materia::getID($param2);
        $this->carrera = Carreras::getID($param1);
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
        return !MateriasCarreras::where('id_materia', '=', $this->materia)->where('id_carrera', '=', $this->carrera)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La carrera "'.$this->carreraID.'" ya tiene asociada la materia "'.$this->materiaID.'".';
    }
}
