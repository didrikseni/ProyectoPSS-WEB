<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->integer('calificacionFinal')->nullable();
            $table->string('calificacionCursada')->nullable();
            $table->foreignId('id_mesa_examen')->nullable()->references('id')->on('mesa_examens')->onDelete('cascade');
            $table->foreignId('id_alumno')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_materia')->nullable()->references('id')->on('materias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
