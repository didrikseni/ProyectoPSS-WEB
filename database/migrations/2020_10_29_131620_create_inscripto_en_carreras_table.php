<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptoEnCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripto_en_carreras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_alumno')->references('id')->on('users');
            $table->foreignId('id_carrera')->references('id')->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripto_en_carreras');
    }
}
