<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesaExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesa_examens', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('horario');
            $table->string('tipo_examen');
            $table->string('observaciones')->nullable();
            $table->foreignId('id_materia')->references('id')->on('materias');
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
        Schema::dropIfExists('mesa_examens');
    }
}
