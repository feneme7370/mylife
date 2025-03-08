<?php

namespace App\Livewire\Media;

use App\Models\MediaGenre;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MediaGenreList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////
    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_media_genre');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_media_genre');}

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

    public $media_genre;
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
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('media_genres', 'name')->ignore($this->media_genre->id ?? 0)],
            'slug' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('media_genres', 'slug')->ignore($this->media_genre->id ?? 0)],
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

        $this->media_genre = MediaGenre::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->media_genre);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->media_genre = MediaGenre::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    // borrar archivo
    public function deleteGenre(){
        
        if ($this->media_genre->medias->isEmpty()) {
            $this->media_genre->delete();

            $this->resetProperties();
            $this->resetErrorBag();
        } else {
            session()->flash('status', 'Contiene elementos en el genero.');
        }

        $this->showDeleteModal = false;

    }

    // editar
    public function saveGenreEdit(){
        // datos automaticos
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();

        // editar datos
        $this->media_genre->update($validatedData);

        $this->reset(['media_genre']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    // guardar
    public function saveGenreCreate(){
        // datos automaticos
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $media = MediaGenre::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// RENDER /////////////////////////////
    public function render()
    {
        $genres = MediaGenre::where('user_id', Auth::user()->id)
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_media_genre');

        return view('livewire.media.media-genre-list', compact(
            'genres',
        ));
    }
}
