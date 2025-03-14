<?php

namespace Database\Seeders\Recipe;

use App\Models\RecipeTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeTag::create(array(
            'name' => 'Picante',
            'slug' => \Illuminate\Support\Str::slug('Picante'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeTag::create(array(
            'name' => 'Italiana',
            'slug' => \Illuminate\Support\Str::slug('Italiana'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));
    }
}
