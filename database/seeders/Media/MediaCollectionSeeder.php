<?php

namespace Database\Seeders\Media;

use App\Models\MediaCollection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MediaCollection::create(array('name' => 'Los Juegos del Hambre','slug' => \Illuminate\Support\Str::slug('Los Juegos del Hambre'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'Shrek','slug' => \Illuminate\Support\Str::slug('Shrek'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'Madagascar','slug' => \Illuminate\Support\Str::slug('Madagascar'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'La Era de Hielo','slug' => \Illuminate\Support\Str::slug('La Era de Hielo'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'DreamWorks','slug' => \Illuminate\Support\Str::slug('DreamWorks'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'Monsters Inc.','slug' => \Illuminate\Support\Str::slug('Monsters Inc.'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'Pixar','slug' => \Illuminate\Support\Str::slug('Pixar'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        MediaCollection::create(array('name' => 'Kung Fu Panda','slug' => \Illuminate\Support\Str::slug('Kung Fu Panda'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
    }
}
