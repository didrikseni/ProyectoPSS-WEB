<?php

namespace Database\Factories;

use App\Models\Carreras;
use App\Models\Departamentos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarrerasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carreras::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profesores = [];
        $departamentos = [];
        foreach (User::where('rol', '=', 'Profesor')->get() as $user) {
            $profesores[] = $user;
        }

        foreach (Departamentos::all() as $departamento) {
            $departamentos[] = $departamento;
        }

        $nombres = [
            'ABOGACIA',
            'AGRIMENSURA',
            'ARQUITECTURA',
            'BIOQUIMICA',
            'CONTADOR PUBLICO',
            'FARMACIA',
            'INGENIERIA AGRONOMICA',
            'INGENIERIA CIVIL',
            'INGENIERIA DE ALIMENTOS',
            'INGENIERIA ELECTRICISTA',
            'INGENIERIA ELECTRONICA',
            'INGENIERIA EN COMPUTACION',
            'INGENIERIA EN SISTEMAS DE INFORMACION',
            'INGENIERIA INDUSTRIAL',
            'INGENIERIA MECANICA',
            'INGENIERIA QUIMICA',
            'LICENCIATURA EN ADMINISTRACION',
            'LICENCIATURA EN CIENCIAS AMBIENTALES',
            'LICENCIATURA EN CIENCIAS BIOLOGICAS',
            'LICENCIATURA EN CIENCIAS DE LA COMPUTACION',
            'LICENCIATURA EN CIENCIAS DE LA EDUCACION',
            'LICENCIATURA EN CIENCIAS GEOLOGICAS',
            'LICENCIATURA EN ECONOMIA',
            'LICENCIATURA EN ENFERMERIA',
            'LICENCIATURA EN FILOSOFIA',
            'LICENCIATURA EN FISICA',
            'LICENCIATURA EN GEOFISICA',
            'LICENCIATURA EN GEOGRAFIA',
            'LICENCIATURA EN GESTIÓN UNIVERSITARIA',
            'LICENCIATURA EN HISTORIA',
            'LICENCIATURA EN LETRAS',
            'LICENCIATURA EN MATEMATICA',
            'LICENCIATURA EN OCEANOGRAFIA',
            'LICENCIATURA EN OPTICA Y CONTACTOLOGÍA',
            'LICENCIATURA EN QUIMICA',
            'LICENCIATURA EN SEGURIDAD PÚBLICA',
            'LICENCIATURA EN TURISMO',
            'MEDICINA',
            'PROFESORADO DE EDUCACION INICIAL',
            'PROFESORADO DE EDUCACION PRIMARIA',
            'PROFESORADO EN CIENCIAS BIOLÓGICAS',
            'PROFESORADO EN ECONOMIA',
            'PROFESORADO EN ECONOMIA PARA LA ENSEÑANZA SECUNDARIA',
            'PROFESORADO EN EDUCACION SECUNDARIA EN CIENCIAS DE LA ADMINISTRACION',
            'PROFESORADO EN EDUCACION SECUNDARIA Y SUPERIOR EN CIENCIAS DE LA ADMINISTRACION',
            'PROFESORADO EN FILOSOFIA',
            'PROFESORADO EN FISICA',
            'PROFESORADO EN GEOCIENCIAS',
            'PROFESORADO EN GEOGRAFIA',
            'PROFESORADO EN HISTORIA',
            'PROFESORADO EN LETRAS',
            'PROFESORADO EN MATEMATICA',
            'PROFESORADO EN QUIMICA',
            'PROFESORADO EN QUIMICA DE LA ENSEÑANZA MEDIA',
            'TECNICATURA SUPERIOR AGRARIA EN SUELOS Y AGUAS',
            'TECNICATURA SUPERIOR EN ADMINISTRACION Y GESTION DE RECURSOS PARA INSTITUCIONES UNIVERSITARIAS',
            'TECNICATURA UNIVERSITARIA APICOLA',
            'TECNICATURA UNIVERSITARIA EN ACOMPAÑAMIENTO TERAPÉUTICO',
            'TECNICATURA UNIVERSITARIA EN CARTOGRAFIA, TELEDETECCION Y SISTEMAS DE INFORMACION GEOGRAFICA',
            'TECNICATURA UNIVERSITARIA EN ECONOMÍA Y GESTIÓN DE EMPRESAS ALIMENTARIAS',
            'TECNICATURA UNIVERSITARIA EN MEDIO AMBIENTE',
            'TECNICATURA UNIVERSITARIA EN OPERACIONES INDUSTRIALES',
            'TECNICATURA UNIVERSITARIA EN OPTICA',
            'TECNICATURA UNIVERSITARIA EN PARQUES Y JARDINES',
            'TECNICATURA UNIVERSITARIA EN SISTEMAS ELECTRÓNICOS INDUSTRIALES INTELIGENTES',
        ];


        return [
            'nombre' => $this->faker->unique()->randomElement($nombres),
            'id_str' => $this->faker->unique()->word(),
            'anio_inicio' => $this->faker->numberBetween(2018, 2020),
            'profesor_responsable' => $this->faker->randomElement($profesores),
            'departamento_responsable' => $this->faker->randomElement($departamentos),
        ];
    }
}
