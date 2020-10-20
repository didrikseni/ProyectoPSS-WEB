<?php

namespace Database\Seeders;

use App\Models\Carreras;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carreras::factory()->times(10)->create();
    }
}
