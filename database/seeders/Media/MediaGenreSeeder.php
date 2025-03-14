<?php

namespace Database\Seeders\Media;

use App\Models\MediaGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediaGenre::create(array('name' => 'Sci-Fi','slug' => \Illuminate\Support\Str::slug('Sci-Fi'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Desarrollo Personal','slug' => \Illuminate\Support\Str::slug('Desarrollo Personal'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Biografia','slug' => \Illuminate\Support\Str::slug('Biografia'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Intriga','slug' => \Illuminate\Support\Str::slug('Intriga'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Terror','slug' => \Illuminate\Support\Str::slug('Terror'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Fantasia','slug' => \Illuminate\Support\Str::slug('Fantasia'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Romance','slug' => \Illuminate\Support\Str::slug('Romance'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Drama','slug' => \Illuminate\Support\Str::slug('Drama'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Anime','slug' => \Illuminate\Support\Str::slug('Anime'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Animacion','slug' => \Illuminate\Support\Str::slug('Animacion'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Comedia','slug' => \Illuminate\Support\Str::slug('Comedia'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Accion','slug' => \Illuminate\Support\Str::slug('Accion'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaGenre::create(array('name' => 'Suspenso','slug' => \Illuminate\Support\Str::slug('Suspenso'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
    }
}
