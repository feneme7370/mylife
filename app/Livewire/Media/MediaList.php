<?php

namespace App\Livewire\Media;

use App\Models\Media;
use App\Models\MediaCollection;
use Livewire\Component;

class MediaList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use \Livewire\WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_media');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_media');}
    public function updatingStatusRead() {$this->resetPage(pageName: 'p_media');}
    public function updatingCollectionSelected() {$this->resetPage(pageName: 'p_media');}

    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10, $status_view = "", $collection_selected, $media_type_selected;

    public $media;

    public $showDeleteModal = false;


    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'status_view' => [ 'as' => 'r' ],
        'collection_selected' => [ 'as' => 'c' ],
        'media_type_selected' => [ 'as' => 'type' ],
        ];
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['media']);
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
    
            $this->media = Media::where('uuid', $uuid)->first();
    
            $this->showDeleteModal = true;
        }
    
        public function deleteMedia(){
    
            if($this->media){
                $this->media->delete();
        
                $this->resetProperties();
                $this->resetErrorBag();
            }else{
                session()->flash('status', 'Error al borrar.');
            }
            $this->showDeleteModal = false;
    
        }

    public function render()
    {
        $type_content = Media::typeContent();
        $status_media = Media::statusMedia();
        
        $collections = MediaCollection::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        
        $medias = Media::with(['user'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('title', 'like', '%'.$this->search . '%');
                // ->orWhereHas('media_author', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // })
                // ->orWhereHas('media_collection', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // });
            });
        })
        ->when( $this->media_type_selected, function($query) {
            return $query->where(function( $query) {
                $query->where('media_type', 'like', '%'.$this->media_type_selected . '%');
            });
        })
        ->when($this->status_view, function( $query) {
            return $query->where('status', $this->status_view);
        })
        ->when($this->status_view, function( $query) {
            return $query->where('status', $this->status_view);
        })
        ->when($this->collection_selected, function ($query) {
            $query->whereHas('media_collections', function ($q) {
                $q->where('media_collections.uuid', $this->collection_selected);
            });
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_media');

        return view('livewire.media.media-list', compact(
            'medias',
            'status_media',
            'collections',
            'type_content',
        ));
    }
}
