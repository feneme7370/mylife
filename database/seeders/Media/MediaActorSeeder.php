<?php

namespace Database\Seeders\Media;

use App\Models\MediaActor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediaActor::create(array(
            'name' => 'Louis Hofmann',
            'slug' => \Illuminate\Support\Str::slug('Louis Hofmann'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Karoline Eichhorn',
            'slug' => \Illuminate\Support\Str::slug('Karoline Eichhorn'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Lisa Vicari',
            'slug' => \Illuminate\Support\Str::slug('Lisa Vicari'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Jennifer Lawrence',
            'slug' => \Illuminate\Support\Str::slug('Jennifer Lawrence'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Josh Hutcherson',
            'slug' => \Illuminate\Support\Str::slug('Josh Hutcherson'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Marie Avgeropoulos',
            'slug' => \Illuminate\Support\Str::slug('Marie Avgeropoulos'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Bob Morley',
            'slug' => \Illuminate\Support\Str::slug('Bob Morley'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));

        MediaActor::create(array(
            'name' => 'Eliza Taylor',
            'slug' => \Illuminate\Support\Str::slug('Eliza Taylor'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));
        
        MediaActor::create(array(
            'name' => 'Griselda Siciliani',
            'slug' => \Illuminate\Support\Str::slug('Griselda Siciliani'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));
        
        MediaActor::create(array(
            'name' => 'Emilia Clarke',
            'slug' => \Illuminate\Support\Str::slug('Emilia Clarke'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));
        
        MediaActor::create(array(
            'name' => 'Peter Dinklage',
            'slug' => \Illuminate\Support\Str::slug('Peter Dinklage'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));
        
        MediaActor::create(array(
            'name' => 'Kit Harington',
            'slug' => \Illuminate\Support\Str::slug('Kit Harington'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => ''
        ));
        
        MediaActor::create(array(
            'name' => 'Natalia Oreiro',
            'slug' => \Illuminate\Support\Str::slug('Natalia Oreiro'),
            'description' => 'Natalia Oreiro nació el 19 de mayo de 1977 en Montevideo, Uruguay. Es una actriz y productora, conocida por Sos mi vida (2006), Gilda, no me arrepiento de este amor (2016) y Infancia clandestina (2011). Está casada con Ricardo Mollo desde el 31 de diciembre de 2001. Tienen un niño.',
            'cover_image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFqWxFrZrmwsuITaCW-o3iqVZFE94AclleXg&s',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => '1977-04-19',
            'country' => 'Montevideo, Uruguay'
        ));
        
        MediaActor::create(array(
            'name' => 'Fernán Mirás',
            'slug' => \Illuminate\Support\Str::slug('Fernán Mirás'),
            'description' => 'Fernán Mirás nació el 17 de julio de 1969 en Buenos Aires, Argentina. Es un actor y director, conocido por El peso de la ley (2017), Casi muerta (2023) y Tango feroz: la leyenda de Tanguito (1993). Está casado con María Amelia. Tienen tres niños.',
            'cover_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Fern%C3%A1n_Mir%C3%A1s_%28cropped%29.jpg/1200px-Fern%C3%A1n_Mir%C3%A1s_%28cropped%29.jpg',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
            'birthdate' => NULL,
            'country' => 'Buenos Aires, Argentina'
        ));
        
    }
}
