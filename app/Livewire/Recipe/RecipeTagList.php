<?php

namespace App\Livewire\Recipe;

use App\Models\RecipeTag;
use Livewire\Component;

class RecipeTagList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////
    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_recipe_tag');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_recipe_tag');}


    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 50;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        ];
    }

    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    // propiedades para el modal
    public $showEditModal = false, $showCreateModal = false, $showDeleteModal = false;

    public $recipe_tag;
    public
    $name,
    $slug,
    $description,

    $cover_image_url,
    
    $uuid,
    $user_id;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////
    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('recipe_tags', 'name')->ignore($this->recipe_tag->id ?? 0)],
            'slug' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('recipe_tags', 'slug')->ignore($this->recipe_tag->id ?? 0)],
            'description' => ['nullable', 'string'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
            'uuid' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'nombre url',
        'description' => 'descripcion',
        'cover_image_url' => 'imagen web',
        'uuid' => 'uuid',

        'user_id' => 'usuario',
    ];

    ///////////////////////////// FUNCIONES BASICAS /////////////////////////////
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'description', 'cover_image_url', 'uuid', 'user_id']);
    }
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
        $this->description = $item['description'];
        $this->cover_image_url = $item['cover_image_url'];
        $this->uuid = $item['uuid'];
        $this->user_id = $item['user_id'];
    }

    ///////////////////////////// FUNCIONES INTERACTIVAS /////////////////////////////
    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->showCreateModal = true;
    }

    // mostrar modal para confirmar editar
    public function editActionModal($uuid) {

        $this->resetProperties();
        $this->resetErrorBag();
        
        $this->recipe_tag = RecipeTag::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->recipe_tag);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->recipe_tag = RecipeTag::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    // borrar archivo
    public function deleteTag(){
        if($this->recipe_tag->recipes->isEmpty()){
            $this->recipe_tag->delete();
    
            $this->resetProperties();
            $this->resetErrorBag();
        }else{
            session()->flash('status', 'Contiene recetas asociadas.');
        }
        $this->showDeleteModal = false;
    }

    // editar
    public function saveTagEdit(){
        // datos automaticos
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();

        // editar datos
        $this->recipe_tag->update($validatedData);

        $this->reset(['recipe_tag']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    // guardar
    public function saveTagCreate(){
        // datos automaticos
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $recipe = RecipeTag::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// RENDER /////////////////////////////
    public function render()
    {
        $tags = RecipeTag::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                ->paginate($this->perPage, pageName: 'p_recipe_tag');

        return view('livewire.recipe.recipe-tag-list', compact(
            'tags',
        ));
    }
}
