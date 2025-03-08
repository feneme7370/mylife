<?php

namespace App\Livewire\Book;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\BookCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookCollectionList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////
    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book_collection');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book_collection');}

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

    public $book_collection;
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
            'name' => ['required', 'string', 'max:255', Rule::unique('book_collections', 'name')->ignore($this->book_collection->id ?? 0)],
            'slug' => ['required', 'string', 'max:255', Rule::unique('book_collections', 'slug')->ignore($this->book_collection->id ?? 0)],

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
    public function editActionModal( $uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->book_collection = BookCollection::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->book_collection);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->book_collection = BookCollection::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    // borrar archivo
    public function deleteCollection(){
        
        if ($this->book_collection->books->isEmpty()) {
            $this->book_collection->delete();

            $this->resetProperties();
            $this->resetErrorBag();
        } else {
            session()->flash('status', 'Contiene libros asociados.');
        }

        $this->showDeleteModal = false;

    }

    // editar
    public function saveCollectionEdit(){
        // datos automaticos
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();

        // editar datos
        $this->book_collection->update($validatedData);

        $this->reset(['book_collection']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    // guardar
    public function saveCollectionCreate(){
        // datos automaticos
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $book = BookCollection::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// RENDER /////////////////////////////
    public function render()
    {
        $collections = BookCollection::where('user_id', Auth::user()->id)
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_book_collection');

        return view('livewire.book.book-collection-list', compact(
            'collections'
        ));
    }
}
