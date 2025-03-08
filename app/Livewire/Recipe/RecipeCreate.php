<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeTag;
use Livewire\Component;

class RecipeCreate extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $title,
    $slug,
    
    $synopsis,
    $ingredients,
    $steps,

    $cover_image,
    $cover_image_url,
    
    $uuid,
    $user_id;

    // propiedades para editar
    public $selected_recipe_categories = [];
    public $selected_recipe_tags = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255'],

            'synopsis' => ['nullable'],
            'ingredients' => ['nullable'],
            'steps' => ['nullable'],
    
            'cover_image'  => ['nullable', 'string', 'max:255'],
            'cover_image_url'  => ['nullable', 'string', 'max:255'],
            
            'uuid' => ['required', 'max:255'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'title' => 'titulo',
        'slug' => 'slug',
        
        'synopsis' => 'sinopsis',
        'ingredients' => 'ingredientes',
        'steps' => 'pasos',
        
        'cover_image'  => 'imagen local',
        'cover_image_url'  => 'link de imagen',
        
        'uuid' => 'ID unico',
        'user_id' => 'usuario',
    ];     

    public function saveRecipe(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->uuid = \Illuminate\Support\Str::random(24);
        
        // validar form
        $validatedData = $this->validate();
        // dd($validatedData);
        $recipe = Recipe::create($validatedData);
        $recipe->recipe_categories()->sync($this->selected_recipe_categories);
        $recipe->recipe_tags()->sync($this->selected_recipe_tags);

        return redirect()->route('recipe_list')->with('message', 'Creado exitosamente');
    }

    public function render()
    {
        $recipe_tags = RecipeTag::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('name', 'ASC')->get();
        $recipe_categories = RecipeCategory::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('name', 'ASC')->get();

        return view('livewire.recipe.recipe-create',compact(
            'recipe_tags',
            'recipe_categories',
        ));
    }
}
