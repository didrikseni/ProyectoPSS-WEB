<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_carreras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_materia')->references('id')->on('materias');
            $table->foreignId('id_carrera')->references('id')->on('carreras');
            $table->string('cuatrimestre');
            $table->integer('anio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias_carreras');
    }
}
