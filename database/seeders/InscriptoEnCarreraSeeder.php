<?php

namespace Database\Seeders;

use App\Models\InscriptoEnCarrera;
use App\Models\User;
use Illuminate\Database\Seeder;

class InscriptoEnCarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = User::where('rol', 'Alumno')->get()->count();
        InscriptoEnCarrera::factory()->times($count)->create();
    }
}
