<?php

namespace Database\Seeders\Book;

use App\Models\BookCollection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookCollection::create(array('name' => 'Los Juegos del Hambre','slug' => \Illuminate\Support\Str::slug('Los Juegos del Hambre'),'description' => 'La serie de películas The Hunger Games (en español, Los juegos del hambre) está compuesta por películas de aventuras distópicas de ciencia ficción, basadas en la trilogía de novelas The Hunger Games de la autora estadounidense Suzanne Collins. Las películas son distribuidas por Lionsgate y producidas por Nina Jacobson y Jon Kilik. La serie cuenta con un elenco que incluye a Jennifer Lawrence, Josh Hutcherson, Liam Hemsworth, Woody Harrelson, Elizabeth Banks, Stanley Tucci y Donald Sutherland. ','cover_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/The_hunger_games.svg/330px-The_hunger_games.svg.png','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        BookCollection::create(array('name' => 'Harry Potter','slug' => \Illuminate\Support\Str::slug('Harry Potter'),'description' => 'La serie cinematográfica de Harry Potter comprende ocho películas basadas en Harry Potter, una serie de siete novelas juveniles escritas por la autora británica J. K. Rowling y protagonizadas por el mago ficticio del mismo nombre. Se trata de películas de cine fantástico, todas basadas en las novelas de la saga y todas estrenadas en el decenio comprendido entre 2001 y 2011.1​ Se realizó una película por cada libro de la saga a excepción del último libro, cuya adaptación cinematográfica ocupó dos películas distintas. ','cover_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Harry_Potter_wordmark.svg/375px-Harry_Potter_wordmark.svg.png','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        BookCollection::create(array('name' => 'Guardianes de la Ciudadela','slug' => \Illuminate\Support\Str::slug('Guardianes de la Ciudadela'),'description' => 'El mundo está plagado de monstruos. Algunos atacan a los viajeros en los caminos, otros asedian las aldeas hasta arrasarlas por completo y otros entran en las casas por las noches para llevarse a los niños mientras duermen. Axlin se ha propuesto investigar todo lo que pueda sobre los monstruos y plasmar sus descubrimientos en un libro que pueda servir de guía y protección a otras personas. Pero a lo largo de su viaje encontrará cosas que jamás habría imaginado cuando partió. ','cover_image_url' => 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1514915878i/37798071._SX120_.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
    }
}
