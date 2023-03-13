<?php

namespace Database\Seeders;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = 1;
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) {
            \DB::table('notificaciones')->insert(array(
                'fechaEnvio' => date('Y-m-d H:m:s'),
                'asunto' => $faker->sentence(),
                'titulo' => $faker->word(),
                'mensaje' => $faker->paragraph(),
                'usuarioId' => $usuario,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
    }
}
