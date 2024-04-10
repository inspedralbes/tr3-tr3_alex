<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SesionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('Sessions')->insert([
            [
                'pelicula_id' => 1,
                'fecha_hora' => '2024-04-04 10:00:00',
                'tipo_sesion' => '3D',
                'subtitulada' => 1,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ],
            [
                'pelicula_id' => 2,
                'fecha_hora' => '2024-04-11 10:00:00',
                'tipo_sesion' => '4DX',
                'subtitulada' => 1,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ],
            [
                'pelicula_id' => 3,
                'fecha_hora' => '2024-04-18 10:00:00',
                'tipo_sesion' => '2D',
                'subtitulada' => 1,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ],
            [
                'pelicula_id' => 4,
                'fecha_hora' => '2024-04-25 10:00:00',
                'tipo_sesion' => '3D',
                'subtitulada' => 1,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ],
            [
                'pelicula_id' => 5,
                'fecha_hora' => '2024-05-02 10:00:00',
                'tipo_sesion' => '4DX',
                'subtitulada' => 1,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ],
            [
                'pelicula_id' => 6,
                'fecha_hora' => '2024-05-02 10:00:00',
                'tipo_sesion' => '2D',
                'subtitulada' => 0,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ], 
            [
                'pelicula_id' => 7,
                'fecha_hora' => '2024-05-02 10:00:00',
                'tipo_sesion' => '3D',
                'subtitulada' => 0,
                'precio' => 10.99,
                'precio_Vip' => 15.99,
                'Vip' => 1
            ]
        ]);
    }
}