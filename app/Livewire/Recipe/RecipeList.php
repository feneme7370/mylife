<?php

namespace App\Livewire\Recipe;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\RecipeTag;
use Livewire\Component;

class RecipeList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_recipe');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_recipe');}
    public function updatingCategorySelected() {$this->resetPage(pageName: 'p_recipe');}
    public function updatingTagSelected() {$this->resetPage(pageName: 'p_recipe');}

    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 50, $status_read = "", $category_selected, $tag_selected;

    public $recipe;

    public $showDeleteModal = false;


    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'status_read' => [ 'as' => 'r' ],
        'category_selected' => [ 'as' => 'c' ],
        'tag_selected' => [ 'as' => 't' ],
        ];
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['recipe']);
    }

    // ordenar la tabla
    public function orderTable($column){
        if($this->sortBy != $column){
            $this->sortBy = $column;
        }else{
            $this->sortAsc = !$this->sortAsc;
        }
    }

        // mostrar modal para confirmar editar
        public function deleteActionModal($uuid) {
            $this->resetProperties();
            $this->resetErrorBag();
    
            $this->recipe = Recipe::where('uuid', $uuid)->first();
    
            $this->showDeleteModal = true;
        }
    
        public function deleteRecipe(){
    
            if($this->recipe){
                $this->recipe->delete();
        
                $this->resetProperties();
                $this->resetErrorBag();
            }else{
                session()->flash('status', 'Error al borrar.');
            }
            $this->showDeleteModal = false;
    
        }

    public function render()
    {

        $recipe_categories = RecipeCategory::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        $recipe_tags = RecipeTag::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        
        $recipes = Recipe::with(['user'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('title', 'like', '%'.$this->search . '%');
                // ->orWhereHas('recipe_author', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // })
                // ->orWhereHas('recipe_collection', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // });
            });
        })
        ->when($this->category_selected, function ($query) {
            $query->whereHas('recipe_categories', function ($q) {
                $q->where('recipe_categories.uuid', $this->category_selected);
            });
        })
        ->when($this->tag_selected, function ($query) {
            $query->whereHas('recipe_tags', function ($q) {
                $q->where('recipe_tags.uuid', $this->tag_selected);
            });
        })

        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_recipe');

        return view('livewire.recipe.recipe-list', compact(
            'recipes',
            'recipe_categories',
            'recipe_tags',
        ));
    }
}
