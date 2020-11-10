<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncriptoEnMesaExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incripto_en_mesa_examens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_alumno')->references('id')->on('users');
            $table->foreignId('id_mesa_examen')->references('id')->on('mesa_examens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incripto_en_mesa_examens');
    }
}
