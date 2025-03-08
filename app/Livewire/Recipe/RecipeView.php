<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use Livewire\Component;

class RecipeView extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public $recipe;

    public function mount($uuid){
        $this->recipe = Recipe::where('uuid', $uuid)->with('recipe_categories', 'recipe_tags')->first();
    }

    public function render()
    {



        return view('livewire.recipe.recipe-view');
    }
}
