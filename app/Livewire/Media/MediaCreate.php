<?php

namespace App\Livewire\Media;

use App\Models\Media;
use Livewire\Component;
use App\Models\MediaTag;
use App\Models\MediaActor;
use App\Models\MediaGenre;
use App\Models\BookReading;
use App\Models\MediaSeason;
use App\Models\MediaWatched;
use App\Models\MediaDirector;
use App\Models\MediaCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MediaCreate extends Component
{
    ///////////////////////////// MODULO ADD DIRECTOR /////////////////////////////

    public $showCreateModalDirector = false;
    public $name_director, $user_id_director, $slug_director, $uuid_director;
    // mostrar modal para confirmar crear
    public function createActionModalDirector()
    {
        $this->resetErrorBag();
        $this->showCreateModalDirector = true;
    }

    // guardar
    public function saveDirectorCreate()
    {
        // datos automaticos
        $this->name_director = $this->name_director;
        $this->slug_director = \Illuminate\Support\Str::slug($this->name_director);
        $this->uuid_director = \Illuminate\Support\Str::random(24);
        $this->user_id_director = \Illuminate\Support\Facades\Auth::user()->id;

        // validar datos
        $validatedData = $this->validate([
            'name_director' => ['required', 'string', 'max:255', Rule::unique('media_directors', 'name')->ignore($this->media_director->id ?? 0)],
            'slug_director' => ['required', 'string', 'max:255', Rule::unique('media_directors', 'slug')->ignore($this->media_director->id ?? 0)],
            'uuid_director' => ['required', 'string', 'max:255'],
            'user_id_director' => ['required', 'numeric', 'min:0'],
        ]);

        // guardar datos
        $media = MediaDirector::create([
            'name' => $this->name_director,
            'slug' => $this->slug_director,
            'uuid' => $this->uuid_director,
            'user_id' => $this->user_id_director,
        ]);

        $this->reset('name_director', 'slug_director', 'uuid_director', 'user_id_director');
        $this->showCreateModalDirector = false;
        $this->dispatch('message', 'Creado con exito');
    }
    ///////////////////////////// MODULO ADD ACTOR /////////////////////////////

    public $showCreateModalActor = false;
    public $name_actor, $user_id_actor, $slug_actor, $uuid_actor;
    // mostrar modal para confirmar crear
    public function createActionModalActor()
    {
        $this->resetErrorBag();
        $this->showCreateModalActor = true;
    }

    // guardar
    public function saveActorCreate()
    {
        // datos automaticos
        $this->name_actor = $this->name_actor;
        $this->slug_actor = \Illuminate\Support\Str::slug($this->name_actor);
        $this->uuid_actor = \Illuminate\Support\Str::random(24);
        $this->user_id_actor = \Illuminate\Support\Facades\Auth::user()->id;

        // validar datos
        $validatedData = $this->validate([
            'name_actor' => ['required', 'string', 'max:255', Rule::unique('media_actors', 'name')->ignore($this->media_actor->id ?? 0)],
            'slug_actor' => ['required', 'string', 'max:255', Rule::unique('media_actors', 'slug')->ignore($this->media_actor->id ?? 0)],
            'uuid_actor' => ['required', 'string', 'max:255'],
            'user_id_actor' => ['required', 'numeric', 'min:0'],
        ]);

        // guardar datos
        $media = MediaActor::create([
            'name' => $this->name_actor,
            'slug' => $this->slug_actor,
            'uuid' => $this->uuid_actor,
            'user_id' => $this->user_id_actor,
        ]);

        $this->reset('name_actor', 'slug_actor', 'uuid_actor', 'user_id_actor');
        $this->showCreateModalActor = false;
        $this->dispatch('message', 'Creado con exito');
    }

    ///////////////////////////// MODULO ADD COLLECTION /////////////////////////////

    public $showCreateModalCollection = false;
    public $name_collection, $user_id_collection, $slug_collection, $uuid_collection;
    // mostrar modal para confirmar crear
    public function createActionModalCollection()
    {
        $this->resetErrorBag();
        $this->showCreateModalCollection = true;
    }

    // guardar
    public function saveCollectionCreate()
    {
        // datos automaticos
        $this->name_collection = $this->name_collection;
        $this->slug_collection = \Illuminate\Support\Str::slug($this->name_collection);
        $this->uuid_collection = \Illuminate\Support\Str::random(24);
        $this->user_id_collection = \Illuminate\Support\Facades\Auth::user()->id;

        // validar datos
        $validatedData = $this->validate([
            'name_collection' => ['required', 'string', 'max:255', Rule::unique('media_collections', 'name')->ignore($this->media_collection->id ?? 0)],
            'slug_collection' => ['required', 'string', 'max:255', Rule::unique('media_collections', 'slug')->ignore($this->media_collection->id ?? 0)],
            'uuid_collection' => ['required', 'string', 'max:255'],
            'user_id_collection' => ['required', 'numeric', 'min:0'],
        ]);

        // guardar datos
        $media = MediaCollection::create([
            'name' => $this->name_collection,
            'slug' => $this->slug_collection,
            'uuid' => $this->uuid_collection,
            'user_id' => $this->user_id_collection,
        ]);

        $this->reset('name_collection', 'slug_collection', 'uuid_collection', 'user_id_collection');
        $this->showCreateModalCollection = false;
        $this->dispatch('message', 'Creado con exito');
    }
    
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $title,
    $slug,

    $original_title,
    $emission_status,
    $format,
    $is_favorite,
    $is_wish,
    
    $synopsis ,
    $release_date,
    // $start_date,
    // $end_date,

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
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255'],

            'original_title' => ['required', 'max:255'],
            'emission_status' => ['nullable', 'numeric', 'min:1'],
            'format' => ['nullable', 'numeric', 'min:1'],
            'is_favorite' => ['nullable', 'numeric', 'min:0', 'max:1'],
            'is_wish' => ['nullable', 'numeric', 'min:0', 'max:1'],
            
            'synopsis' => ['nullable'],
            'release_date' => ['nullable', 'date'],
            // 'start_date' => ['nullable', 'date'],
            // 'end_date' => ['nullable', 'date'],
    
            
            'number_collection' => ['nullable', 'numeric', 'min:1'],
            'media_type' => ['nullable', 'numeric', 'min:1', 'max:2'],
    
            'duration'  => ['nullable', 'numeric', 'min:1'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'personal_description' => ['nullable', 'string'],
    
            'cover_image'  => ['nullable', 'string', 'max:255'],
            'cover_image_url'  => ['nullable', 'string', 'max:255'],
    
            'status' => ['nullable', 'numeric', 'max:10'],
            
            'uuid' => ['required', 'max:255'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'title' => 'titulo',
        'slug' => 'slug',

        'original_title' => 'titulo original',
        'emission_status' => 'estado de emision',
        'format' => 'formato',
        'is_favorite' => 'lista de favorito',
        'is_wish' => 'lista de deseo',
        
        'synopsis' => 'sinopsis',
        'release_date' => 'fecha de publicacion',
        // 'start_date' => 'fecha de comienzo',
        // 'end_date' => 'fecha de finalizacion',

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

    public $media_watcheds = [];
    public function addMediaWatched()
    {
        $this->media_watcheds[] = ['start_date_table' => '', 'end_date_table' => ''];
    }
    public function removeMediaWatched($index)
    {
        unset($this->media_watcheds[$index]);
        $this->media_watcheds = array_values($this->media_watcheds); // Reindexar array
    }
   

    public function saveMedia(){
        $this->user_id = Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->uuid = \Illuminate\Support\Str::random(24);
        
        $this->media_type = $this->type;
        $this->rating = $this->rating == '' ? 0 : $this->rating;
        $this->number_collection = $this->number_collection == '' ? 1 : $this->number_collection;

        $this->is_favorite = $this->is_favorite == true ? 1 : 0;
        $this->is_wish = $this->is_wish == true ? 1 : 0;

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

        if ($this->media_watcheds) {
            foreach ($this->media_watcheds as $media_watched) {
                MediaWatched::create([
                    'media_id' => $media->id,
                    'user_id' => Auth::user()->id,
                    'start_date' => $media_watched['start_date_table'],
                    'end_date' => $media_watched['end_date_table'],
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
        $formats = Media::format();
        $emissions_status = Media::emission_status();

        return view('livewire.media.media-create',compact(
            'media_actors',
            'media_directors',
            'media_collections',
            'media_tags',
            'media_genres',
            'status_media',
            'valoration_stars',
            'type_content',
            'formats',
            'emissions_status',
        ));
    }
}
