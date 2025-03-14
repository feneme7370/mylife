<?php

namespace Database\Seeders\Recipe;

use App\Models\RecipeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeCategory::create(array(
            'name' => 'Postre 🥞',
            'slug' => \Illuminate\Support\Str::slug('Postre 🥞'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Masas y Panes 🍞',
            'slug' => \Illuminate\Support\Str::slug('Masas y Panes 🍞'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Salsas y Aderezos 🫙',
            'slug' => \Illuminate\Support\Str::slug('Salsas y Aderezos 🫙'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Ensaladas 🥗',
            'slug' => \Illuminate\Support\Str::slug('Ensaladas 🥗'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Tartas y Empanadas 🥟',
            'slug' => \Illuminate\Support\Str::slug('Tartas y Empanadas 🥟'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Pescados y Mariscos 🐟',
            'slug' => \Illuminate\Support\Str::slug('Pescados y Mariscos 🐟'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Carnes 🥩',
            'slug' => \Illuminate\Support\Str::slug('Carnes 🥩'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        RecipeCategory::create(array(
            'name' => 'Pastas 🍝',
            'slug' => \Illuminate\Support\Str::slug('Pastas 🍝'),
            'description' => NULL,
            'cover_image_url' => NULL,
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));
    }
}
