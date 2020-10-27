<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaCorrelativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_correlativas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_materia')->references('id')->on('materias');
            $table->foreignId('id_correlativa')->references('id')->on('materias');
            $table->unsignedSmallInteger('tipo', false);
            $table->unique(['id_materia', 'id_correlativa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_correlativas');
    }
}
