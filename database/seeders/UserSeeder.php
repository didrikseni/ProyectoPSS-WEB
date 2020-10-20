<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->fill([
            'nombre' => 'Alberto',
            'apellido' => 'Perez',
            'fecha_nacimiento' => '1998-03-27',
            'lugar_nacimiento' => 'Bahia Blanca',
            'DNI' => '41071020',
            'direccion_calle' => 'Alem',
            'direccion_numero' => '123',
            'numero_telefono' => '291453272',
            'legajo' => '1',
            'nombre_usuario' => 'aperez',
            'rol' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make( '12345678'),
            'escuela_secundaria' => 'Ciclo Básico',
        ]);

        $admin->save();

        $student = new User();
        $student->fill([
            'nombre' => 'Jose',
            'apellido' => 'Gomez',
            'fecha_nacimiento' => '1981-12-21',
            'lugar_nacimiento' => 'Bahia Blanca',
            'DNI' => '41071099',
            'direccion_calle' => 'Alem',
            'direccion_numero' => '123',
            'numero_telefono' => '291453291',
            'legajo' => '2',
            'nombre_usuario' => 'jgomez',
            'rol' => 'Alumno',
            'email' => 'alumno@gmail.com',
            'password' => Hash::make( '12345678'),
            'escuela_secundaria' => 'Nacional',
        ]);

        $student->save();

        $professor = new User();
        $professor->fill([
            'nombre' => 'Ana',
            'apellido' => 'Robles',
            'fecha_nacimiento' => '1969-03-27',
            'lugar_nacimiento' => 'Tres Arroyos',
            'DNI' => '32145672',
            'direccion_calle' => 'Alsina',
            'direccion_numero' => '1232',
            'numero_telefono' => '291567875',
            'legajo' => '3',
            'nombre_usuario' => 'arobles',
            'rol' => 'Profesor',
            'email' => 'profesor@gmail.com',
            'password' => Hash::make( '12345678'),
            'escuela_secundaria' => 'Don Bosco',
        ]);

        $professor->save();


        for($i = 0; $i < 20; $i++) {
            User::factory()->times(1)->create();
        }
    }
}
