<?php

namespace App\Livewire\Media;

use App\Models\Media;
use App\Models\MediaActor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MediaCollection;
use App\Models\MediaDirector;
use App\Models\MediaTag;
use Illuminate\Support\Facades\Auth;

class MediaLibrary extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_media');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_media');}
    public function updatingStatusRead() {$this->resetPage(pageName: 'p_media');}
    public function updatingCollectionSelected() {$this->resetPage(pageName: 'p_media');}
    public function updatingActorSelected() {$this->resetPage(pageName: 'p_media');}
    public function updatingDirectorSelected() {$this->resetPage(pageName: 'p_media');}
    public function updatingTagSelected() {$this->resetPage(pageName: 'p_media');}

    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 30, $status_read = "", $collection_selected, $actor_selected, $director_selected, $tag_selected;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'status_read' => [ 'as' => 'r' ],
        'collection_selected' => [ 'as' => 'c' ],
        'actor_selected' => [ 'as' => 'a' ],
        'director_selected' => [ 'as' => 'd' ],
        'tag_selected' => [ 'as' => 't' ],
        ];
    }

    // ordenar la tabla
    public function orderTable($column){
        if($this->sortBy != $column){
            $this->sortBy = $column;
        }else{
            $this->sortAsc = !$this->sortAsc;
        }
    }

    public function render()
    {
        $status_media = Media::statusMedia();
        
        $media_collections = MediaCollection::where('user_id', Auth::user()->id)->get();
        $media_actors = MediaActor::where('user_id', Auth::user()->id)->get();
        $media_directors = MediaDirector::where('user_id', Auth::user()->id)->get();
        $media_tags = MediaTag::where('user_id', Auth::user()->id)->get();

        $medias = Media::with(['user'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('title', 'like', '%'.$this->search . '%');
                // ->orWhereHas('media_collection', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // });
            });
        })
        ->when($this->status_read, function( $query) {
            return $query->where('status', $this->status_read);
        })
        ->when($this->tag_selected, function ($query) {
            $query->whereHas('media_tags', function ($q) {
                $q->where('media_tags.uuid', $this->tag_selected);
            });
        })
        ->when($this->actor_selected, function ($query) {
            $query->whereHas('media_actors', function ($q) {
                $q->where('media_actors.uuid', $this->actor_selected);
            });
        })
        ->when($this->director_selected, function ($query) {
            $query->whereHas('media_directors', function ($q) {
                $q->where('media_directors.uuid', $this->director_selected);
            });
        })
        ->when($this->collection_selected, function ($query) {
            $query->whereHas('media_collections', function ($q) {
                $q->where('media_collections.uuid', $this->collection_selected);
            });
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_media');

        return view('livewire.media.media-library', compact(
            'medias',
            'status_media',
            'media_collections',
            'media_actors',
            'media_directors',
            'media_tags',
        ));
    }
}
