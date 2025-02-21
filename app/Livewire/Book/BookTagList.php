<?php

namespace App\Livewire\Book;

use App\Models\BookTag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookTagList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book_tag');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book_tag');}
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

    public $book_tag;
    public
    $name,
    $slug,

    $uuid,
    
    $user_id;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', Rule::unique('book_tags', 'name')->ignore($this->book_tag->id ?? 0)],
            'slug' => ['required', 'string', Rule::unique('book_tags', 'slug')->ignore($this->book_tag->id ?? 0)],

            'uuid' => ['required', 'string'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }
    

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'nombre url',

        'uuid' => 'uuid',
        'user_id' => 'usuario',
    ];

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'uuid', 'user_id']);
    }
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
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

        $this->book_tag = BookTag::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->book_tag);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->book_tag = BookTag::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    public function deleteTag(){
        
        if ($this->book_tag->books->isEmpty()) {
            $this->book_tag->delete();

            $this->resetProperties();
            $this->resetErrorBag();
        } else {
            session()->flash('status', 'Contiene elementos en la colección.');
        }

        $this->showDeleteModal = false;

    }

    // guardar
    public function saveTagEdit(){
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();
        // editar datos
        $this->book_tag->update($validatedData);

        $this->reset(['book_tag']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    public function saveTagCreate(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(20);

        // validar form
        $validatedData = $this->validate();
        
        $book = BookTag::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    public function render()
    {
        $tags = BookTag::where('user_id', Auth::user()->id)
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_book_tag');

        return view('livewire.book.book-tag-list', compact(
            'tags',
        ));
    }
}
