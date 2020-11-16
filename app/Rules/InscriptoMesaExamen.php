<?php

namespace App\Rules;

use App\Models\IncriptoEnMesaExamen;
use App\Models\MesaExamen;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class InscriptoMesaExamen implements Rule
{
    private $mesa;

    /**
     * Create a new rule instance.
     *
     * @param string $param
     */
    public function __construct(string $param)
    {
        $this->mesa = MesaExamen::findOrFail($param);
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
        $alumno = User::findOrFail($value);
        return IncriptoEnMesaExamen::where('id_alumno', $alumno->id)->where('id_mesa_examen',$this->mesa->id)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El alumno debe estar inscripto en la mesa de examen.';
    }
}
