<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
             'name' => 'admin iaw',
             'email' => 'admin@iaw.com',
             'password' => bcrypt('admin123'),
         ]);

        $this->call(MarcaSeeder::class);
        $this->call(ReservaSeed::class);
        $this->call(VehiculoSeed::class);
        $this->call(ReservaDetallesSeed::class);
         
    }
}
