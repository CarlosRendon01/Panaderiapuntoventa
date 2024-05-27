<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedidos')->insert([
            [
                'nombre' => 'Pedido 1',
                'cliente' => 'Cliente 1',
                'total' => 200,
                'descripcion' => 'Descripción del pedido 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedido 2',
                'cliente' => 'Cliente 2',
                'total' => 300,
                'descripcion' => 'Descripción del pedido 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Agrega más pedidos según sea necesario
        ]);
    }
}
