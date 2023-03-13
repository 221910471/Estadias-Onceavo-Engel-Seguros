<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VentasSeeder::class);
        $this->call(FamiliasSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(NotificacionesSeeder::class);
    }
}
