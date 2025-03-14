<?php

namespace Database\Seeders;

use App\Models\RecipeTag;
use Database\Seeders\Book\BookAuthorSeeder;
use Database\Seeders\Book\BookCollectionSeeder;
use Database\Seeders\Book\BookGenreSeeder;
use Database\Seeders\Book\BookSeeder;
use Database\Seeders\Media\MediaGenreSeeder;
use Database\Seeders\Media\MediaTagSeeder;
use Database\Seeders\Book\BookTagSeeder;
use Database\Seeders\Extra\ExtraPhraseSeeder;
use Database\Seeders\Media\MediaActorSeeder;
use Database\Seeders\Media\MediaCollectionSeeder;
use Database\Seeders\Media\MediaDirectorSeeder;
use Database\Seeders\Media\MediaSeeder;
use Database\Seeders\Recipe\RecipeCategorySeeder;
use Database\Seeders\Recipe\RecipeSeeder;
use Database\Seeders\Recipe\RecipeTagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            BookTagSeeder::class,
            MediaTagSeeder::class,
            RecipeTagSeeder::class,

            BookGenreSeeder::class,
            MediaGenreSeeder::class,

            BookCollectionSeeder::class,
            MediaCollectionSeeder::class,

            RecipeCategorySeeder::class,

            BookAuthorSeeder::class,
            MediaActorSeeder::class,
            MediaDirectorSeeder::class,

            ExtraPhraseSeeder::class,

            RecipeSeeder::class,
            BookSeeder::class,
            MediaSeeder::class,
            
        ]);
    }
}
