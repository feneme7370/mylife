<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use App\Models\BookAuthor;
use App\Models\BookCollection;
use App\Models\BookTag;
use Illuminate\Support\Facades\Auth;

class BookEdit extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $book,

    $title,
    $slug,
    $book_author_id,
    $synopsis ,
    $release_date,

    $book_collection_id,
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
    public $selected_book_tags = [];
    
    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'title' => ['required'],
            'slug' => ['required'],
            'book_author_id' => ['nullable', 'numeric', 'min:0'],
            'synopsis' => ['nullable'],
            'release_date' => ['nullable'],
    
            'book_collection_id' => ['required', 'numeric', 'min:0'],
            'number_collection' => ['nullable', 'numeric'],
    
            'pages'  => ['nullable', 'numeric'],
            'rating' => ['nullable', 'numeric', 'min:1', 'max:5'],
            'personal_description' => ['nullable', 'string'],
    
            // 'cover_image'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'cover_image'  => ['nullable', 'string'],
            'cover_image_url'  => ['nullable', 'string'],
    
            'status' => ['nullable', 'numeric'],
            
            'uuid' => ['required', 'string'],
            'user_id' => ['required', 'numeric', 'min:0'],
        ];
    }
    
    // renombrar variables a castellano
    protected $validationAttributes = [
        'title' => 'titulo',
        'slug' => 'slug',
        'book_author_id' => 'autor',
        'synopsis' => 'sinopsis',
        'release_date' => 'fecha de publicacion',

        'book_collection_id' => 'collecion',
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
    
    public function mount($id){

        $book = Book::find($id);
        $this->book = $book;

        $this->title = $book['title'];
        $this->book_author_id = $book['book_author_id'];
        $this->synopsis = $book['synopsis'] ;
        $this->release_date = $book['release_date'];

        $this->book_collection_id = $book['book_collection_id'];
        $this->number_collection = $book['number_collection'];

        $this->pages = $book['pages'];
        $this->rating = $book['rating'];
        $this->personal_description = $book['personal_description'];

        $this->cover_image = $book['cover_image'];
        $this->cover_image_url = $book['cover_image_url'];

        $this->uuid = $book['uuid'];
        $this->status = $book['status'];

        $this->selected_book_tags = $book->book_tags->pluck('id')->toArray();
    }


    public function saveBook(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);

        // validar form
        $validatedData = $this->validate();
        
        $this->book->update($validatedData);
        $this->book->book_tags()->sync($this->selected_book_tags);

        return redirect()->route('book_list')->with('message', 'Editado exitosamente');
    }
    public function render()
    {
        $authors = BookAuthor::where('user_id', Auth::user()->id)->get();
        $collections = BookCollection::where('user_id', Auth::user()->id)->get();
        $statusBook = [1 => 'Quiero leer', 2 => 'Leído', 3 => 'Leyendo'];
        $book_tags = BookTag::where('user_id', Auth::user()->id)->get();
        $valoration_stars = [1 => '⭐', 2 => '⭐⭐', 3 => '⭐⭐⭐', 4 => '⭐⭐⭐⭐', 5 => '⭐⭐⭐⭐⭐'];

        return view('livewire.book.book-edit', compact(
            'authors',
            'collections',
            'book_tags',
            'statusBook',
            'valoration_stars',
        ));
    }
}
