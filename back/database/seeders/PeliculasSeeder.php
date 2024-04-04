<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('peliculas')->insert([
            [
                'id' => 1,
                'titulo' => 'Spider-Man: No Way Home',
                'duracion' => 148,
                'poster' => 'spiderman_no_way_home.jpeg',
                'sinopsis' => 'Peter Parker busca ayuda para deshacer un hechizo que ha hecho que el mundo olvide su identidad secreta.',
                'created_at' => '2024-03-15 11:11:18',
                'updated_at' => '2024-03-15 11:11:18'
            ],
            [
                'id' => 2,
                'titulo' => 'Parasite',
                'duracion' => 132,
                'poster' => 'parasyte.jpg',
                'sinopsis' => 'Una familia pobre se inserta en la vida de una familia rica, llevando a consecuencias inesperadas.',
                'created_at' => '2024-03-15 11:10:42',
                'updated_at' => '2024-03-15 11:10:42'
            ],
            [
                'id' => 3,
                'titulo' => 'King Kong',
                'duracion' => 128,
                'poster' => 'Kingkong.jpg',
                'sinopsis' => 'Durante la Gran Depresión, Ann Darrow (Naomi Watts), una actriz de vodevil, se queda sin trabajo. Su suerte parece cambiar cuando conoce a Carl Denham (Jack Black), un empresario que lucha para abrirse camino en el mundo del espectáculo. A ellos se une Jack Driscoll (Adrien Brody), un autor de teatro. Los tres emprenden un viaje a una remota isla, donde Denham tiene previsto dirigir una película. En una frondosa selva, descubren a King Kong, un gorila gigantesco, y a una tribu de seres prehistóricos que han vivido ocultos durante millones de años. Movido por su insaciable ambición, Denham, planea la captura del gorila con el propósito de exhibirlo en Nueva York.',
                'created_at' => '2024-03-15 11:10:42',
                'updated_at' => '2024-03-15 11:10:42'
            ],
            [
                'id' => 4,
                'titulo' => 'Avengers: Endgame',
                'duracion' => 181,
                'poster' => 'Endgame.jpg',
                'sinopsis' => 'Los Vengadores intentan revertir los efectos de la aniquilación masiva causada por Thanos.',
                'created_at' => '2024-03-15 11:11:18',
                'updated_at' => '2024-03-15 11:11:18'
            ],
            [
                'id' => 5,
                'titulo' => 'Your Name',
                'duracion' => 106,
                'poster' => 'yourname.jpg',
                'sinopsis' => 'Un chico de la ciudad y una chica de un pueblo intercambian cuerpos en sus sueños.',
                'created_at' => '2024-03-15 11:11:18',
                'updated_at' => '2024-03-15 11:11:18'
            ],
            [
                'id' => 6,
                'titulo' => 'Berserk: Golden Age',
                'duracion' => 120,
                'poster' => 'berserk_golden_age.webp',
                'sinopsis' => 'Guts, un guerrero solitario con un pasado oscuro, se une a los Jinetes del Halcón, liderados por Griffith, en su búsqueda de gloria y venganza en un mundo medieval brutal.',
                'created_at' => '2024-04-04 10:00:00',
                'updated_at' => '2024-04-04 10:00:00'
            ],
            [
                'id' => 7,
                'titulo' => 'Godzilla (1998)',
                'duracion' => 139,
                'poster' => 'godzilla.webp',
                'sinopsis' => 'Un enorme monstruo mutante creado por la exposición a la radiación nuclear causa estragos en Nueva York, mientras el ejército lucha por detenerlo.',
                'created_at' => '2024-04-04 11:00:00',
                'updated_at' => '2024-04-04 11:00:00'
            ]
        ]);
    }
}