<?php

namespace App\Livewire\Media;

use App\Models\Media;
use Livewire\Component;
use App\Models\MediaTag;
use App\Models\MediaActor;
use App\Models\MediaDirector;
use App\Models\MediaCollection;
use App\Models\MediaGenre;
use App\Models\MediaSeason;
use Illuminate\Support\Facades\Auth;

class MediaCreate extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
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
    public $selected_media_genres = [];
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
        $this->seasons[] = ['title' => '', 'episodes_count' => 0, 'description' => ''];
    }
    public function removeSeason($index)
    {
        unset($this->seasons[$index]);
        $this->seasons = array_values($this->seasons); // Reindexar array
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
        $this->user_id = Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->uuid = \Illuminate\Support\Str::random(24);
        
        $this->media_type = $this->type;

        // validar form
        $validatedData = $this->validate();
        // dd($validatedData);
        $media = Media::create($validatedData);
        $media->media_genres()->sync($this->selected_media_genres);
        $media->media_tags()->sync($this->selected_media_tags);
        $media->media_actors()->sync($this->selected_media_actors);
        $media->media_directors()->sync($this->selected_media_directors);
        $media->media_collections()->sync($this->selected_media_collections);

        if ($this->media_type == 2) {
            foreach ($this->seasons as $season) {
                MediaSeason::create([
                    'media_id' => $media->id,
                    'title' => $season['title'],
                    'episodes_count' => $season['episodes_count'],
                    'description' => $season['description'],
                ]);
            }
        }


        return redirect()->route('media_list')->with('message', 'Creado exitosamente');
    }

    public function render()
    {
        $media_actors = MediaActor::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_directors = MediaDirector::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_collections = MediaCollection::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_tags = MediaTag::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $media_genres = MediaGenre::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();

        $type_content = Media::typeContent();
        $status_media = Media::statusMedia();
        $valoration_stars = Media::valorationStars();

        return view('livewire.media.media-create',compact(
            'media_actors',
            'media_directors',
            'media_collections',
            'media_tags',
            'media_genres',
            'status_media',
            'valoration_stars',
            'type_content',
        ));
    }
}
