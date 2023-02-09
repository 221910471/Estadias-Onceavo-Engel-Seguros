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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45)->comment('Nombre(s) del usuario');
            $table->string('apellidoPaterno', 25)->comment('Primer apellido');
            $table->string('apellidoMaterno', 25)->nullable()->comment('Segundo apellido');
            $table->string('telefono')->comment('Número telefonico');
            $table->string('contrasena')->comment('contrasena');
            $table->string('correoElectronico')->unique()->comment('Dirección de correo electronico');
            $table->enum('rol', ['Administrador', 'Cliente', 'Interno'])->comment('Tipo usuario o nivel de cuenta');          
            $table->date('fechaDeNacimiento')->comment('Fecha de nacimiento');
            $table->string('identificacion')->nullable()->comment('Foto o imagen de la identificacion');
            $table->string('tarjetaDeCirculacion')->nullable()->comment('Imagen de la tarjeta de circulacion de un  vehiculo');
            $table->string('comprobanteDomiciliario')->nullable()->comment('Imagen o fotografia de un comprobante domiciliario');
            $table->string('estadoDeSesion')->comment('Campo para verificar el primer acceso al sistema');
            $table->string('estado')->comment('Campo para registrar una baja logica en el sistema');

            $table->unsignedBigInteger('familiaId'); 
            $table->foreign('familiaId')->references('id')->on('familias');

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
        Schema::dropIfExists('usuarios');
    }
};
