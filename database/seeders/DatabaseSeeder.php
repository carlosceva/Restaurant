<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
            PromocionSeeder::class,
            MenuSeeder::class,
            EmpresaSeeder::class,
            RoleSeeder::class,
            PrivilegioSeeder::class,
            UserSeeder::class,
            EmpleadoSeeder::class,
            ClienteSeeder::class,
            ServicioSeeder::class,
            VentaSeeder::class,
            DetalleVentaSeeder::class,
            PagoSeeder::class,
            DetalleMenuSeeder::class
        ]);
    }
}
