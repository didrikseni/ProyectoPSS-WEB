<?php

namespace Database\Factories;

use App\Models\IncriptoEnMesaExamen;
use App\Models\User;
use App\Models\MesaExamen;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncriptoEnMesaExamenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncriptoEnMesaExamen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $alumnos = User::where('rol', '=', 'Alumno')->get();
        $mesasExamen = MesaExamen::select('*')->get();
        return [
            'id_alumno' => $this->faker->unique()->randomElement($alumnos),
            'id_mesa_examen' => $this->faker->randomElement($mesasExamen),
        ];
    }
}
