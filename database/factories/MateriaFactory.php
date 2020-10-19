<?php

namespace Database\Factories;

use App\Models\Materia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MateriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Materia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profesores = [];
        foreach (User::where('rol', '=', 'Profesor')->get() as $user) {
            $profesores[] = $user;
        }
        return [
            'nombre' => $this->faker->name,
            'id_str' => $this->faker->unique()->word(),
            'departamento' => $this->faker->numberBetween(1, 16),
            'id_profesor' => $this->faker->randomElement($profesores),
            'id_asistente' => $this->faker->randomElement($profesores),
        ];
    }
}
