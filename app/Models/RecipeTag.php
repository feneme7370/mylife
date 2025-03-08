<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image_url',
        'uuid',
        'user_id',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_recipe_tag')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
