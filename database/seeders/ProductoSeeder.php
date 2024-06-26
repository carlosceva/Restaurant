<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            ['nombre' => 'Punta de S',
            'descripcion'=> 'Corte punta de S o picaña, acompañado de arroz batido y yuca',
            'precio'=> 35,
            'id_categoria'=> 1,
            ],
            ['nombre' => 'Ensalada Cesar',
            'descripcion'=> 'ensalada de lechuga romana, pechuga de pollo troceada y croutons con jugo de limón, aceite de oliva, huevo',
            'precio'=> 25,
            'id_categoria'=> 2,
            ],
            ['nombre' => 'Sopa de mani',
            'descripcion'=> 'Sopa de maní, un caldo hecho con maní crudo licuado, verduras y tu proteína favorita. Se sirve con un poco de papas fritas caseras y se acompaña con rodajas de pan francés.',
            'precio'=> 15,
            'id_categoria'=> 3,
            ],
            ['nombre' => 'Ensalada de frutas',
            'descripcion'=> 'plato fresco, saludable, lleno de color y sabor. Es rica en fibras, vitaminas y minerales',
            'precio'=> 10,
            'id_categoria'=> 4,
            ],
            ['nombre' => 'Coca cola 2lt',
            'descripcion'=> 'Bebida carbonatada de cola, con capacidad de 2 litros',
            'precio'=> 15,
            'id_categoria'=> 5,
            ],
        ]);
    }
}
