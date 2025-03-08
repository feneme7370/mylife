<?php

namespace App\Livewire\Book;

use Livewire\Component;
use App\Models\BookAuthor;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookAuthorList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////
    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book_author');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book_author');}

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

    public $book_author;
    public
    $name,
    $slug,
    $birthdate,
    $description,
    $country,
    $cover_image_url,
    
    $uuid,
    $user_id;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////
    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('book_authors', 'name')->ignore($this->book_author->id ?? 0)],
            'slug' => ['required', 'string', 'max:255', Rule::unique('book_authors', 'slug')->ignore($this->book_author->id ?? 0)],
            'birthdate' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'uuid' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }
    
    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'nombre url',
        'birthdate' => 'fecha de nacimiento',
        'description' => 'descripcion',
        'cover_image_url' => 'imagen web',
        'country' => 'pais',
        'uuid' => 'uuid',

        'user_id' => 'usuario',
    ];

    ///////////////////////////// FUNCIONES BASICAS /////////////////////////////
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'birthdate', 'description', 'cover_image_url', 'country', 'uuid', 'user_id']);
    }
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
        $this->birthdate = $item['birthdate'];
        $this->description = $item['description'];
        $this->cover_image_url = $item['cover_image_url'];
        $this->country = $item['country'];
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
        
        $this->book_author = BookAuthor::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->book_author);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->book_author = BookAuthor::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    // borrar archivo
    public function deleteAuthor(){

        if($this->book_author->books->isEmpty()){
            $this->book_author->delete();
    
            $this->resetProperties();
            $this->resetErrorBag();
        }else{
            session()->flash('status', 'Contiene libros asociados.');
        }
        $this->showDeleteModal = false;

    }

    // editar
    public function saveAuthorEdit(){
        // datos automaticos
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();

        // editar datos
        $this->book_author->update($validatedData);

        $this->reset(['book_author']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    // guardar
    public function saveAuthorCreate(){
        // datos automaticos
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar datos
        $validatedData = $this->validate();
        
        // guardar datos
        $book = BookAuthor::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// RENDER /////////////////////////////
    public function render()
    {
        $authors = BookAuthor::where('user_id', Auth::user()->id)
                ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                ->paginate($this->perPage, pageName: 'p_book_author');

        return view('livewire.book.book-author-list', compact(
            'authors',
        ));
    }
}
