<?php

namespace Database\Factories;

use App\Models\Carreras;
use App\Models\Materia;
use App\Models\MateriasCarreras;
use Illuminate\Database\Eloquent\Factories\Factory;

class MateriasCarrerasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MateriasCarreras::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $carreras = Carreras::all();
        $materias = Materia::all();

        return [
            'id_materia' => $this->faker->randomElement($materias)->id,
            'id_carrera' => $this->faker->randomElement($carreras)->id,
            'cuatrimestre' => $this->faker->numberBetween(0, 1),
            'anio' => $this->faker->numberBetween(0, 7),
        ];
    }
}
