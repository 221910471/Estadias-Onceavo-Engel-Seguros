<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $default = 1;
        $imagenPorDefecto = "default.png";
        \DB::table('usuarios')->insert(array(
            'nombre'  => "Josue",
            'apellidoPaterno' => "Manjarrez",
            'apellidoMaterno' => "Careaga",
            'telefono'  => "7228590824",
            'contrasena' => Hash::make('12345678'),
            'correoElectronico' => "al221910471@gmail.com",
            'rol' => "Administrador",
            'fechaDeNacimiento' => date('Y-m-d H:m:s'),
            'identificacion' => $imagenPorDefecto,
            'tarjetaDeCirculacion' => $imagenPorDefecto,
            'comprobanteDomiciliario' => $imagenPorDefecto,
            'estadoDeSesion' => $default,
            'activo' => $default,
            'familiaId' => $default,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        
        ));

        \DB::table('usuarios')->insert(array(
            'nombre'  => "Manuel",
            'apellidoPaterno' => "Tizapatzin",
            'apellidoMaterno' => "",
            'telefono'  => "7222674924",
            'contrasena' => Hash::make('12345678'),
            'correoElectronico' => "contacto@engelagente.com",
            'rol' => "Administrador",
            'fechaDeNacimiento' => date('Y-m-d H:m:s'),
            'identificacion' => $imagenPorDefecto,
            'tarjetaDeCirculacion' => $imagenPorDefecto,
            'comprobanteDomiciliario' => $imagenPorDefecto,
            'estadoDeSesion' => $default,
            'activo' => $default,
            'familiaId' => $default,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        
        ));

        \DB::table('usuarios')->insert(array(
            'nombre'  => "Diego",
            'apellidoPaterno' => "Ruben",
            'apellidoMaterno' => "Santenelli",
            'telefono'  => "5551819132",
            'contrasena' => Hash::make('12345678'),
            'correoElectronico' => "contacto@diegocoach.com",
            'rol' => "Administrador",
            'fechaDeNacimiento' => date('Y-m-d H:m:s'),
            'identificacion' => $imagenPorDefecto,
            'tarjetaDeCirculacion' => $imagenPorDefecto,
            'comprobanteDomiciliario' => $imagenPorDefecto,
            'estadoDeSesion' => $default,
            'activo' => $default,
            'familiaId' => $default,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        
        ));
    }
}
