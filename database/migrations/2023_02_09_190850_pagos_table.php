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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('clave');
            $table->enum('frecuenciaDePago', ['Mensual', 'Bimestral', 'Semestral', 'Anual'])->comment('Periodo de tiempo entre pagos');          
            $table->date('fechaDePago')->comment('Fecha de pago');
            $table->date('fechaLimiteDePago')->comment('Fecha máxima en la que se puede realizar un pago de pago');
            $table->string('estado')->comment('Campo para conocer si el pago ya se realizo o no');
            $table->string('formaDePago');
            $table->float ('montoDePago', 12, 2);

            $table->unsignedBigInteger('polizaId'); 
            $table->foreign('polizaId')->references('id')->on('polizas');

            $table->unsignedBigInteger('usuarioId'); 
            $table->foreign('usuarioId')->references('id')->on('usuarios');

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
        Schema::dropIfExists('pagos');
    }
};
