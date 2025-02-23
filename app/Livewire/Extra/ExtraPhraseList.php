<?php

namespace App\Livewire\Extra;

use App\Models\Phrase;
use Livewire\Component;
use App\Models\ExtraPhrase;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ExtraPhraseList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_extra_phrase');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_extra_phrase');}
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

    public $extra_phrase;
    public
    $name,
    $description,

    $uuid,
    
    $user_id;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', Rule::unique('extra_phrases', 'name')->ignore($this->extra_phrase->id ?? 0)],
            'description' => ['nullable', 'string'],
            
            'uuid' => ['required', 'string'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }
    

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'description' => 'descripcion',
        
        'uuid' => 'uuid',
        'user_id' => 'usuario',
    ];

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'description', 'uuid', 'user_id']);
    }
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->description = $item['description'];
        
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

        $this->extra_phrase = ExtraPhrase::where('uuid', $uuid)->first();

        $this->preloadEditModal($this->extra_phrase);

        $this->showEditModal = true;
    }

    // mostrar modal para confirmar editar
    public function deleteActionModal($uuid) {
        $this->resetProperties();
        $this->resetErrorBag();

        $this->extra_phrase = ExtraPhrase::where('uuid', $uuid)->first();

        $this->showDeleteModal = true;
    }

    public function deletePhrase(){
        
        if ($this->extra_phrase) {
            $this->extra_phrase->delete();

            $this->resetProperties();
            $this->resetErrorBag();
        } else {
            session()->flash('status', 'Error al borrar.');
        }

        $this->showDeleteModal = false;

    }

    // guardar
    public function savePhraseEdit(){
        

        // validar datos
        $validatedData = $this->validate();
        // editar datos
        $this->extra_phrase->update($validatedData);

        $this->reset(['extra_phrase']);
        $this->resetProperties();
        $this->showEditModal = false;

        $this->dispatch('message', 'Actualizado con exito');
    }

    public function savePhraseCreate(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->uuid = \Illuminate\Support\Str::random(24);

        // validar form
        $validatedData = $this->validate();
        
        $extra = ExtraPhrase::create($validatedData);

        $this->resetProperties();
        $this->showCreateModal = false;
        $this->dispatch('message', 'Creado con exito');
    }

    public function render()
    {
        $phrases = ExtraPhrase::where('user_id', Auth::user()->id)
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_extra_phrase');

        return view('livewire.extra.extra-phrase-list', compact(
            'phrases',
        ));
    }
}
