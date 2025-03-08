<?php

namespace App\Livewire\Media;

use App\Models\MediaDirector;
use Livewire\Component;

class MediaDirectorList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////
    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_media_director');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_media_director');}

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

    public $media_director;
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
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('media_directors', 'name')->ignore($this->media_director->id ?? 0)],
            'slug' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('media_directors', 'slug')->ignore($this->media_director->id ?? 0)],
            'birthdate' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'country' => ['nullable', 'string', 'max:255'],
            'cover_image_url' => ['nullable', 'string', 'max:255'],
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
        'country' => 'pais',
        'cover_image_url' => 'imagen web',
        'uuid' => 'uuid',

        'user_id' => 'usuario',
    ];

    ///////////////////////////// FUNCIONES BASICAS /////////////////////////////
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'birthdate', 'description', 'country', 'cover_image_url', 'uuid', 'user_id']);
    }
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
        $this->birthdate = $item['birthdate'];
        $this->description = $item['description'];
        $this->country = $item['country'];
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
        
        $this->media_director = MediaDirector::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->media_director);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->media_director = MediaDirector::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    // borrar archivo
    public function deleteDirector(){

        if($this->media_director->medias->isEmpty()){
            $this->media_director->delete();
    
            $this->resetProperties();
            $this->resetErrorBag();
        }else{
            session()->flash('status', 'Contiene peliculas o series asociadas.');
        }
        $this->showDeleteModal = false;

    }

    // editar
    public function saveDirectorEdit(){
        // datos automaticos
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        // validar datos
        $validatedData = $this->validate();

        // editar datos
        $this->media_director->update($validatedData);

        $this->reset(['media_director']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    // guardar
    public function saveDirectorCreate(){
        // datos automaticos
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->name);
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $media = MediaDirector::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// RENDER /////////////////////////////
    public function render()
    {
        $directors = MediaDirector::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                ->paginate($this->perPage, pageName: 'p_media_director');

        return view('livewire.media.media-director-list', compact(
            'directors',
        ));
    }
}
