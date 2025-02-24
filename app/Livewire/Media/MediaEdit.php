<?php

namespace App\Livewire\Media;

use App\Models\Media;
use Livewire\Component;
use App\Models\MediaTag;
use App\Models\MediaActor;
use App\Models\MediaSeason;
use App\Models\MediaDirector;
use App\Models\MediaCollection;
use Illuminate\Support\Facades\Auth;

class MediaEdit extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $media,

    $title,
    $slug,
    $synopsis ,
    $release_date,
    $start_date,
    $end_date,

    $number_collection,

    $media_type,

    $duration,
    $rating,
    $personal_description,

    $cover_image,
    $cover_image_url,

    $status,
    
    $uuid,
    $user_id;

    // propiedad de url
    public $type;

    // propiedades para editar
    public $selected_media_tags = [];
    public $selected_media_actors = [];
    public $selected_media_directors = [];
    public $selected_media_collections = [];
    
    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'title' => ['required'],
            'slug' => ['required'],
            
            'synopsis' => ['nullable'],
            'release_date' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
    
            
            'number_collection' => ['nullable', 'numeric'],
            'media_type' => ['nullable', 'numeric', 'min:1', 'max:2'],
    
            'duration'  => ['nullable', 'numeric'],
            'rating' => ['nullable', 'numeric', 'min:1', 'max:5'],
            'personal_description' => ['nullable', 'string'],
    
            'cover_image'  => ['nullable', 'string'],
            'cover_image_url'  => ['nullable', 'string'],
    
            'status' => ['nullable', 'numeric'],
            
            'uuid' => ['required'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'title' => 'titulo',
        'slug' => 'slug',
        
        'synopsis' => 'sinopsis',
        'release_date' => 'fecha de publicacion',
        'start_date' => 'fecha de comienzo',
        'end_date' => 'fecha de finalizacion',

        'media_type' => 'tipo de contenido',
        'number_collection' => 'numero de collecion',

        'duration'  => 'duracion',
        'rating' => 'valoracion',
        'personal_description' => 'descripcion personal',

        'cover_image'  => 'imagen local',
        'cover_image_url'  => 'link de imagen',

        'status' => 'estado',
        
        'uuid' => 'ID unico',
        'user_id' => 'usuario',
    ];
    
    public $seasons = [];
    public function addSeason()
    {
        $this->seasons[] = ['id' => null, 'title' => '', 'episodes_count' => 0, 'description' => ''];
    }
    public function removeSeason($index)
    {
        if (!empty($this->seasons[$index]['id'])) {
            MediaSeason::find($this->seasons[$index]['id'])->delete();
        }
        
        unset($this->seasons[$index]);
        $this->seasons = array_values($this->seasons); // Reindexar array
    }

    public function mount($uuid){

        $media = Media::where('uuid', $uuid)->first();
        $this->media = $media;

        $this->title = $media['title'];
        
        $this->synopsis = $media['synopsis'] ;
        $this->release_date = $media['release_date'];
        $this->start_date = $media['start_date'];
        $this->end_date = $media['end_date'];

        $this->number_collection = $media['number_collection'];

        $this->media_type = $media['media_type'];
        $this->duration = $media['duration'];
        $this->rating = $media['rating'];
        $this->personal_description = $media['personal_description'];

        $this->cover_image = $media['cover_image'];
        $this->cover_image_url = $media['cover_image_url'];

        $this->uuid = $media['uuid'];
        $this->status = $media['status'];

        $this->selected_media_tags = $media->media_tags->pluck('id')->toArray();
        $this->selected_media_actors = $media->media_actors->pluck('id')->toArray();
        $this->selected_media_directors = $media->media_directors->pluck('id')->toArray();
        $this->selected_media_collections = $media->media_collections->pluck('id')->toArray();

        if ($this->media_type == 2) {
            $this->seasons = $media->seasons->map(function ($season) {
                return [
                    'id' => $season->id,
                    'title' => $season->title,
                    'episodes_count' => $season->episodes_count,
                    'description' => $season->description,
                ];
            })->toArray();
        }
    }

    public function updated($propertyName)
    {
        $this->updateStatus();
    }

    public function updateStatus()
    {
        if (empty($this->start_date) && empty($this->end_date)) {
            $this->status = 1;
        } elseif (!empty($this->start_date) && empty($this->end_date)) {
            $this->status = 3;
        } elseif (!empty($this->start_date) && !empty($this->end_date)) {
            $this->status = 2;
        } elseif (empty($this->start_date) && !empty($this->end_date)) {
            $this->status = 2;
        }
    }     


    public function saveMedia(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        
        $this->media_type = $this->type;

        // validar form
        $validatedData = $this->validate();
        
        $this->media->update($validatedData);
        $this->media->media_tags()->sync($this->selected_media_tags);
        $this->media->media_actors()->sync($this->selected_media_actors);
        $this->media->media_directors()->sync($this->selected_media_directors);
        $this->media->media_collections()->sync($this->selected_media_collections);

        if ($this->media_type == 2) {
            foreach ($this->seasons as $season) {
                if ($season['id']) {
                    MediaSeason::find($season['id'])->update([
                        'title' => $season['title'],
                        'episodes_count' => $season['episodes_count'],
                        'description' => $season['description'],
                    ]);
                } else {
                    MediaSeason::create([
                        'media_id' => $this->media->id,
                        'title' => $season['title'],
                        'episodes_count' => $season['episodes_count'],
                        'description' => $season['description'],
                    ]);
                }
            }
            
        }

        return redirect()->route('media_list')->with('message', 'Editado exitosamente');
    }
    public function render()
    {
        $media_actors = MediaActor::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_directors = MediaDirector::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_collections = MediaCollection::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_tags = MediaTag::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        
        $type_content = Media::typeContent();
        $status_media = Media::statusMedia();
        $valoration_stars = Media::valorationStars();

        return view('livewire.media.media-edit', compact(
            'media_actors',
            'media_directors',
            'media_collections',
            'media_tags',
            'status_media',
            'valoration_stars',
            'type_content',
        ));
    }
}
