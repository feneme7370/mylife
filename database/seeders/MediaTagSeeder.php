<?php

namespace Database\Seeders;

use App\Models\MediaTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            MediaTag::create(array('name' => 'Intriga','slug' => \Illuminate\Support\Str::slug('Intriga'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Epoca','slug' => \Illuminate\Support\Str::slug('Epoca'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Supervivencia','slug' => \Illuminate\Support\Str::slug('Supervivencia'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Viajes en el tiempo','slug' => \Illuminate\Support\Str::slug('Viajes en el tiempo'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Postapocaliptico','slug' => \Illuminate\Support\Str::slug('Postapocaliptico'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Distopico','slug' => \Illuminate\Support\Str::slug('Distopico'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Criaturas','slug' => \Illuminate\Support\Str::slug('Criaturas'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Familiar','slug' => \Illuminate\Support\Str::slug('Familiar'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Navidad','slug' => \Illuminate\Support\Str::slug('Navidad'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Juvenil','slug' => \Illuminate\Support\Str::slug('Juvenil'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Inspiradora','slug' => \Illuminate\Support\Str::slug('Inspiradora'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Prehistoria','slug' => \Illuminate\Support\Str::slug('Prehistoria'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Futurista','slug' => \Illuminate\Support\Str::slug('Futurista'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
            MediaTag::create(array('name' => 'Mitologia','slug' => \Illuminate\Support\Str::slug('Mitologia'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));
        
    }
}
