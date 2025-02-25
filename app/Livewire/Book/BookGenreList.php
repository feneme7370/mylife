<?php

namespace App\Livewire\Book;

use App\Models\BookGenre;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookGenreList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book_genre');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book_genre');}
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
    public $showEditModal = false;
    public $showCreateModal = false;
    public $showDeleteModal = false;

    public $book_genre;
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
            'name' => ['required', 'string', \Illuminate\Validation\Rule::unique('book_genres', 'name')->ignore($this->book_genre->id ?? 0)],
            'slug' => ['required', 'string', \Illuminate\Validation\Rule::unique('book_genres', 'slug')->ignore($this->book_genre->id ?? 0)],
            'description' => ['nullable', 'string'],
            'cover_image_url' => ['nullable', 'string'],
            'uuid' => ['required', 'string'],
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

        $this->book_genre = BookGenre::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->book_genre);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->book_genre = BookGenre::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    public function deleteGenre(){
        
        if ($this->book_genre->books->isEmpty()) {
            $this->book_genre->delete();

            $this->resetProperties();
            $this->resetErrorBag();
        } else {
            session()->flash('status', 'Contiene elementos en el genero.');
        }

        $this->showDeleteModal = false;

    }

    // guardar
    public function saveGenreEdit(){
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();
        // editar datos
        $this->book_genre->update($validatedData);

        $this->reset(['book_genre']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    public function saveGenreCreate(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $book = BookGenre::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    public function render()
    {
        $genres = BookGenre::where('user_id', Auth::user()->id)
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_book_genre');

        return view('livewire.book.book-genre-list', compact(
            'genres',
        ));
    }
}
