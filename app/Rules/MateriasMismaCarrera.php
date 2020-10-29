<?php

namespace App\Rules;

use App\Models\Materia;
use App\Models\materia_correlativa;
use App\Models\MateriasCarreras;
use Illuminate\Contracts\Validation\Rule;

class MateriasMismaCarrera implements Rule
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
        $carrerasMateria = MateriasCarreras::where('id_materia', $this->materia)->get();
        $val = false;

        foreach ($carrerasMateria as $cmat) {
            $ccor = MateriasCarreras::where('id_carrera', $cmat->id_carrera)->where('id_materia', $this->correlativa)->first();
            if ($ccor !== null) {
                $val = true;
                break;
            }
        }

        return $val;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La materia "'.$this->correlativaID.'" y la materia "'.$this->materiaID.'" no pertenecen a la misma carrera.';
    }
}
