<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use App\Models\BookAuthor;
use App\Models\BookCollection;
use App\Models\BookGenre;
use App\Models\BookTag;
use Illuminate\Support\Facades\Auth;

class BookEdit extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $book,

    $title,
    $slug,

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
            'title' => ['required'],
            'slug' => ['required'],
            
            'synopsis' => ['nullable'],
            'release_date' => ['nullable'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'media_type' => ['nullable', 'numeric'],
    
            'number_collection' => ['nullable', 'numeric'],
    
            'pages'  => ['nullable', 'numeric'],
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

        'pages'  => 'paginas',
        'rating' => 'valoracion',
        'personal_description' => 'descripcion personal',

        'cover_image'  => 'imagen local',
        'cover_image_url'  => 'link de imagen',

        'status' => 'estado',
        
        'uuid' => 'ID unico',
        'user_id' => 'usuario',
    ];
    
    public function mount($uuid){

        $book = Book::where('uuid', $uuid)->first();
        $this->book = $book;

        $this->title = $book['title'];
        
        $this->synopsis = $book['synopsis'] ;
        $this->release_date = $book['release_date'];
        $this->start_date = $book['start_date'];
        $this->end_date = $book['end_date'];

        $this->media_type = $book['media_type'];
        $this->number_collection = $book['number_collection'];

        $this->pages = $book['pages'];
        $this->rating = $book['rating'];
        $this->personal_description = $book['personal_description'];

        $this->cover_image = $book['cover_image'];
        $this->cover_image_url = $book['cover_image_url'];

        $this->uuid = $book['uuid'];
        $this->status = $book['status'];

        $this->selected_book_genres = $book->book_genres->pluck('id')->toArray();
        $this->selected_book_tags = $book->book_tags->pluck('id')->toArray();
        $this->selected_book_authors = $book->book_authors->pluck('id')->toArray();
        $this->selected_book_collections = $book->book_collections->pluck('id')->toArray();
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


    public function saveBook(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        
        // validar form
        $validatedData = $this->validate();
        
        $this->book->update($validatedData);
        $this->book->book_genres()->sync($this->selected_book_genres);
        $this->book->book_tags()->sync($this->selected_book_tags);
        $this->book->book_authors()->sync($this->selected_book_authors);
        $this->book->book_collections()->sync($this->selected_book_collections);

        return redirect()->route('book_list')->with('message', 'Editado exitosamente');
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

        return view('livewire.book.book-edit', compact(
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
