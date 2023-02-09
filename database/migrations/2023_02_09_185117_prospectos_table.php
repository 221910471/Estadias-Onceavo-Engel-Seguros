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
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200)->comment('Nombrey apellido del usuario');
            $table->string('telefono')->comment('Número telefonico');
            $table->string('correoElectronico')->unique()->comment('Dirección de correo electronico');
            $table->string('estado')->comment('Campo para registrar una baja logica en el sistema');

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
        Schema::dropIfExists('prospectos');
    }
};
