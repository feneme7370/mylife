<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\BookTag;
use Livewire\Component;
use App\Models\BookGenre;
use App\Models\BookAuthor;
use App\Models\BookReading;
use App\Models\BookCollection;
use BcMath\Number;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class BookCreate extends Component
{
    ///////////////////////////// MODULO ADD AUTHOR /////////////////////////////

    public $showCreateModalAuthor = false;
    public $name_author, $user_id_author, $slug_author, $uuid_author;
    // mostrar modal para confirmar crear
    public function createActionModalAuthor()
    {
        $this->resetErrorBag();
        $this->showCreateModalAuthor = true;
    }

    // guardar
    public function saveAuthorCreate()
    {
        // datos automaticos
        $this->name_author = $this->name_author;
        $this->slug_author = \Illuminate\Support\Str::slug($this->name_author);
        $this->uuid_author = \Illuminate\Support\Str::random(24);
        $this->user_id_author = \Illuminate\Support\Facades\Auth::user()->id;

        // validar datos
        $validatedData = $this->validate([
            'name_author' => ['required', 'string', 'max:255', Rule::unique('book_authors', 'name')->ignore($this->book_author->id ?? 0)],
            'slug_author' => ['required', 'string', 'max:255', Rule::unique('book_authors', 'slug')->ignore($this->book_author->id ?? 0)],
            'uuid_author' => ['required', 'string', 'max:255'],
            'user_id_author' => ['required', 'numeric', 'min:0'],
        ]);

        // guardar datos
        $book = BookAuthor::create([
            'name' => $this->name_author,
            'slug' => $this->slug_author,
            'uuid' => $this->uuid_author,
            'user_id' => $this->user_id_author,
        ]);

        $this->reset('name_author', 'slug_author', 'uuid_author', 'user_id_author');

        $this->showCreateModalAuthor = false;
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
            'name_collection' => ['required', 'string', 'max:255', Rule::unique('book_collections', 'name')->ignore($this->book_collection->id ?? 0)],
            'slug_collection' => ['required', 'string', 'max:255', Rule::unique('book_collections', 'slug')->ignore($this->book_collection->id ?? 0)],
            'uuid_collection' => ['required', 'string', 'max:255'],
            'user_id_collection' => ['required', 'numeric', 'min:0'],
        ]);

        // guardar datos
        $book = BookCollection::create([
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
    $start_date,
    $end_date,

    $media_type,
    $number_collection,

    $pages,
    $rating,
    $personal_description,

    $cover_image,
    $cover_image_url,

    $status,
    
    $uuid,
    $user_id;

    // propiedades para editar
    public $selected_book_genres = [];
    public $selected_book_tags = [];
    public $selected_book_authors = [];
    public $selected_book_collections = [];

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
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'media_type' => ['nullable', 'numeric', 'min:1'],
    
            'number_collection' => ['nullable', 'numeric', 'min:1'],
    
            'pages'  => ['nullable', 'numeric', 'min:1'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:10'],
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
        'start_date' => 'fecha de comienzo',
        'end_date' => 'fecha de finalizacion',
        'media_type' => 'tipo de contenido',

        'number_collection' => 'numero de collecion',

        'pages'  => 'paginas',
        'rating' => 'valoracion',
        'personal_description' => 'descripcion personal',

        'cover_image'  => 'imagen local',
        'cover_image_url'  => 'link de imagen',

        'status' => 'estado',
        
        'uuid' => 'ID unico',
        'user_id' => 'usuario',
    ];

    public $book_readings = [];
    public function addBookReading()
    {
        $this->book_readings[] = ['start_date_table' => '', 'end_date_table' => ''];
    }
    public function removeBookReading($index)
    {
        unset($this->book_readings[$index]);
        $this->book_readings = array_values($this->book_readings); // Reindexar array
    }

    public function saveBook(){
        $this->user_id = Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->uuid = \Illuminate\Support\Str::random(24);
        $this->rating = $this->rating == '' ? 0 : $this->rating;
        $this->number_collection = $this->number_collection == '' ? 1 : $this->number_collection;

        $this->is_favorite = $this->is_favorite == true ? 1 : 0;
        $this->is_wish = $this->is_wish == true ? 1 : 0;
        
        // validar form
        $validatedData = $this->validate();
        // dd($validatedData);
        $book = Book::create($validatedData);
        $book->book_genres()->sync($this->selected_book_genres);
        $book->book_tags()->sync($this->selected_book_tags);
        $book->book_authors()->sync($this->selected_book_authors);
        $book->book_collections()->sync($this->selected_book_collections);

        if ($this->book_readings) {
            foreach ($this->book_readings as $book_reading) {
                BookReading::create([
                    'book_id' => $book->id,
                    'user_id' => Auth::user()->id,
                    'start_date' => $book_reading['start_date_table'],
                    'end_date' => $book_reading['end_date_table'],
                ]);
            }
        }

        return redirect()->route('book_list')->with('message', 'Creado exitosamente');
    }

    public function render()
    {
        $book_authors = BookAuthor::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $book_collections = BookCollection::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $book_tags = BookTag::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $book_genres = BookGenre::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();

        $type_content = Book::typeContent();
        $status_book = Book::statusBook();
        $valoration_stars = Book::valorationStars();
        $formats = Book::format();
        $emissions_status = Book::emission_status();

        return view('livewire.book.book-create',compact(
            'book_authors',
            'book_collections',
            'book_tags',
            'book_genres',
            'status_book',
            'valoration_stars',
            'type_content',
            'formats',
            'emissions_status',
        ));
    }
}
