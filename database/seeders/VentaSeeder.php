<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ventas')->insert([
            ['fecha' => '2024-06-25',
            'total' => 50,
            'id_cliente' => 1,
            'id_empleado' => 2,
            'id_servicio' => 2],
        ]);
    }
}
