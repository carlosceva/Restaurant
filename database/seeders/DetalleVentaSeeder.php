<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detalle_ventas')->insert([
            ['cantidad' => 1,
            'id_producto' => 1,
            'id_venta' => 1],

            ['cantidad' => 1,
            'id_producto' => 5,
            'id_venta' => 1],
        ]);
    }
}
