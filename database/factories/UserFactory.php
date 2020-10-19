<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = $this->faker->name;
        $apellido = $this->faker->name;
        $legajo = User::getLegajo();
        $nombre_usuario = User::getUserName($nombre, $apellido);
        return [
            'nombre' => $nombre,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
            'apellido'=> $apellido,            
            'DNI' => $this->faker->numberBetween($min = 10000000, $max = 99999999),
            'fecha_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'lugar_nacimiento' => $this->faker->name,
            'direccion_calle' => $this->faker->name,
            'direccion_numero' => $this->faker->numberBetween($min = 1, $max = 999),
            'escuela_secundaria' => $this->faker->name,
            'numero_telefono' => $this->faker->numberBetween($min = 10000000, $max = 99999999),
            'legajo' => $legajo,
            'rol' => $this->faker->randomElement(['Administrador', 'Alumno', 'Profesor']),
            'nombre_usuario' => $nombre_usuario,
        ];
    }
}
