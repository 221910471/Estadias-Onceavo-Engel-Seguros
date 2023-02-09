<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();        
            $table->date('fechaEnvio')->comment('Fecha en la que se realizo la notificación');
            $table->string('estado')->comment('Campo para registrar una baja logica en el sistema');

            $table->unsignedBigInteger('usuarioId');
            $table->foreign('usuarioId')->references('id')->on('usuarios');
            $table->unsignedBigInteger('contenidoId');
            $table->foreign('contenidoId')->references('id')->on('contenidos');

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
        Schema::dropIfExists('notificaciones');
    }
};
