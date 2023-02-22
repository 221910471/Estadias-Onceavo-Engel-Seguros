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
            // $table->string('activo')->comment('Campo para registrar una baja logica en el sistema');
            $table->string('asunto', 45)->comment('Tipo o razón ed la notificacion');
            $table->string('titulo', 255)->comment('titulo de la publicación');
            $table->string('mensaje', 255)->nullable()->comment('Contenido de la notificación');

            $table->unsignedBigInteger('usuarioId');
            $table->foreign('usuarioId')->references('id')->on('usuarios');
            // $table->unsignedBigInteger('contenidoId');
            // $table->foreign('contenidoId')->references('id')->on('contenidos');

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
