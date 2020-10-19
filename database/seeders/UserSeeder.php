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
        $user = new User();
        $user->fill([
            'nombre' => 'Admin',
            'apellido' => 'istrador',
            'fecha_nacimiento' => '1998-03-27',
            'lugar_nacimiento' => 'Bahia Blanca',
            'DNI' => '41071020',
            'direccion_calle' => 'Alem',
            'direccion_numero' => '123',
            'numero_telefono' => '291453272',
            'legajo' => '1',
            'nombre_usuario' => 'aistador',
            'rol' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make( '12345678'),
            'escuela_secundaria' => 'Ciclo Básico',
        ]);

        $user->save();

        for($i = 0; $i < 20; $i++) {
            User::factory()->times(1)->create();
        }
    }
}
