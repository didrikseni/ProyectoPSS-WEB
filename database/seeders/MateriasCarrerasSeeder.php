<?php

namespace Database\Seeders;

use App\Models\Carreras;
use App\Models\MateriasCarreras;
use Illuminate\Database\Seeder;

class MateriasCarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MateriasCarreras::factory()->times(20)->create();
    }
}
