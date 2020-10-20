<?php

namespace Database\Factories;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarrerasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carreras::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profesores = [];
        $departamentos = [];
        foreach (User::where('rol', '=', 'Profesor')->get() as $user) {
            $profesores[] = $user;
        }

        foreach (Departamentos::all() as $departamento) {
            $departamentos[] = $departamento;
        }

        return [
            'nombre' => $this->faker->name,
            'id_str' => $this->faker->unique()->word(),
            'anio_inicio' => $this->faker->numberBetween(2018, 2020),
            'profesor_responsable' => $this->faker->randomElement($profesores),
            'departamento_responsable' => $this->faker->randomElement($departamentos),
        ];
    }
}
