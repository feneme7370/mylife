<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCollection;
use App\Models\BookGenre;
use App\Models\BookTag;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookCreate extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $title,
    $slug,
    // $book_author_id,
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

    public function saveBook(){
        $this->user_id = Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->uuid = \Illuminate\Support\Str::random(24);
        $this->rating = $this->rating == '' ? 0 : $this->rating;
        $this->number_collection = $this->number_collection == '' ? 1 : $this->number_collection;
        
        // validar form
        $validatedData = $this->validate();
        // dd($validatedData);
        $book = Book::create($validatedData);
        $book->book_genres()->sync($this->selected_book_genres);
        $book->book_tags()->sync($this->selected_book_tags);
        $book->book_authors()->sync($this->selected_book_authors);
        $book->book_collections()->sync($this->selected_book_collections);

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

        return view('livewire.book.book-create',compact(
            'book_authors',
            'book_collections',
            'book_tags',
            'book_genres',
            'status_book',
            'valoration_stars',
            'type_content',
        ));
    }
}
