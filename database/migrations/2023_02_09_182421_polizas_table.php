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
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->string('clave');
            $table->string('rutaArchivo');    
            $table->string('nombreArchivo');
            $table->date('fechaDeRegistro')->comment('Fecha en la que se registra la poliza');
            $table->enum('tipoPoliza', ['Daños', 'Vida', 'Medico'])->comment('Tipo poliza');
            // $table->string('estado')->comment('Campo para registrar una baja logica en el sistema');
            $table->unsignedBigInteger('ventaId');
            $table->foreign('ventaId')->references('id')->on('ventas');

            $table->softDeletes();
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
        Schema::dropIfExists('polizas');
    }
};
