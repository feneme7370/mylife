<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'slug',
        
        'synopsis',
        'ingredients',
        'steps',

        'cover_image',
        'cover_image_url',

        'uuid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function recipe_tags()
    {
        return $this->belongsToMany(RecipeTag::class, 'recipe_recipe_tag')
                    ->withTimestamps();
    }
    public function recipe_categories()
    {
        return $this->belongsToMany(RecipeCategory::class, 'recipe_recipe_category')
                    ->withTimestamps();
    }

    public static function typeContent()
    {
        return [
            1 => 'Sopas y Cremas', 
            2 => 'Ensaladas',
            3 => 'Salsas y Aderezos',
            4 => 'Panes y Masas',
            5 => 'Pastas',
            6 => 'Carnes',
            7 => 'Aves',
            8 => 'Pescados y Mariscos',
            9 => 'Verduras y Guarniciones',
            10 => 'Sandwiches y Hamburguesas',
            11 => 'Tartas y Empanadas',
            12 => 'Otros',
        ];
    }
    public static function title()
    {
        return 'Receta 🍽️';
    }
}
