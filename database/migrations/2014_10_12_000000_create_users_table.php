<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->integer('DNI')->unique();
            $table->string('email')->unique();
            $table->string('nombre_usuario')->unique();
            $table->string('escuela_secundaria');
            $table->string('direccion_calle');
            $table->string('direccion_numero');
            $table->integer('numero_telefono');
            $table->string('rol');
            $table->integer('legajo')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
