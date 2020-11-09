<?php

namespace Database\Factories;

use App\Models\MesaExamen;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

class MesaExamenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MesaExamen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $materias = Materia::all();
        $tipo_examen =['Regular', 'Libre'];
        return [
            'fecha' => $this->faker->date($format = 'Y-m-d', $min = 'now'),
            'horario' => $this->faker->time($format = ' H:i', $min = 'now'),
            'id_materia' => $this->faker->randomElement($materias),
            'tipo_examen' => $this->faker->randomElement($tipo_examen),
            'observaciones' =>$this->faker->text($maxNbChars = 30),
        ];
    }
}
