<?php

namespace Database\Seeders;

use App\Models\Carreras;
use App\Models\Departamentos;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createDeptaramentos();
        $this->call(UserSeeder::class);
        $this->call(MateriaSeeder::class);
        $this->call(CarrerasSeeder::class);
        $this->call(InscriptoEnCarreraSeeder::class);
    }

    private function createDeptaramentos()
    {
        Departamentos::create(array('nombre' => 'AGRONOMIA'));
        Departamentos::create(array('nombre' => 'BIOLOGIA BIOQUIMICA Y FARMACIA'));
        Departamentos::create(array('nombre' => 'CIENCIAS DE LA ADMINISTRACION'));
        Departamentos::create(array('nombre' => 'CIENCIAS DE LA SALUD'));
        Departamentos::create(array('nombre' => 'CIENCIAS E INGENIERIAS DE LA COMPUTACION'));
        Departamentos::create(array('nombre' => 'CONVENIO IDIOMAS EXTRANJEROS'));
        Departamentos::create(array('nombre' => 'DERECHO'));
        Departamentos::create(array('nombre' => 'ECONOMIA'));
        Departamentos::create(array('nombre' => 'FISICA'));
        Departamentos::create(array('nombre' => 'GEOGRAFIA Y TURISMO'));
        Departamentos::create(array('nombre' => 'GEOLOGIA'));
        Departamentos::create(array('nombre' => 'HUMANIDADES'));
        Departamentos::create(array('nombre' => 'INGENIERIA'));
        Departamentos::create(array('nombre' => 'INGENIERIA ELECTRICA Y DE COMPUTADORAS'));
        Departamentos::create(array('nombre' => 'INGENIERIA QUIMICA'));
        Departamentos::create(array('nombre' => 'QUIMICA'));
    }
}
