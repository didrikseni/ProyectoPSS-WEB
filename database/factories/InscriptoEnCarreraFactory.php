<?php

namespace Database\Factories;

use App\Models\Carreras;
use App\Models\InscriptoEnCarrera;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscriptoEnCarreraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InscriptoEnCarrera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $alumnos = User::where('rol', '=', 'Alumno')->get();
        $carreras = Carreras::select('*')->get();
        return [
            'id_alumno' => $this->faker->unique()->randomElement($alumnos),
            'id_carrera' => $this->faker->randomElement($carreras),
        ];
    }
}
