<?php

namespace Database\Seeders;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $usuarioId = 1;
        for ($i=0; $i < 50; $i++) {
            \DB::table('ventas')->insert(array(
                'usuarioId' => $usuarioId,
                // 'sabor'  => $faker->randomElement(['chocolate','vainilla','cheesecake']),
                'created_at' => date('Y-m-d H:m:s'),
                'fecha' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ));
        }
    }
}
