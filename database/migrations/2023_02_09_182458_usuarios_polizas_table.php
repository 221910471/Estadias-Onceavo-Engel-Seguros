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
        Schema::create('usuarios_polizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('polizaId');
            $table->foreign('polizaId')->references('id')->on('polizas');
            $table->unsignedBigInteger('usuarioId');
            $table->foreign('usuarioId')->references('id')->on('usuarios');

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
        Schema::dropIfExists('usuarios_polizas');
    }
};
