<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PuntoVentasTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puntoventas = [
            [
                'descripcion' => 'Punto de Venta 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'descripcion' => 'Punto de Venta 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('puntoventas')->insert($puntoventas);
    }
}
