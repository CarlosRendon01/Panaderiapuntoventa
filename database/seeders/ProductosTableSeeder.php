<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductosTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
                'nombre' => 'Producto 1',
                'descripcion' => 'Descripción del Producto 1',
                'precio' => 10.00,
                'cantidad' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Producto 2',
                'descripcion' => 'Descripción del Producto 2',
                'precio' => 20.00,
                'cantidad' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('productos')->insert($productos);
    }
}
