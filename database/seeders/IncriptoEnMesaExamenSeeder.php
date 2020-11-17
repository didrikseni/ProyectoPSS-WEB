<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IncriptoEnMesaExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InscriptoEnMesaExamenFactory::factory()->times(20)->create();
    }
}
