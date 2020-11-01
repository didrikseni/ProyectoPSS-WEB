<?php

namespace Database\Seeders;

use App\Models\MesaExamen;
use Illuminate\Database\Seeder;

class MesaExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MesaExamen::factory()->times(10)->create();
    }
}
