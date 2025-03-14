<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\BookTag;
use Livewire\Component;
use App\Models\BookGenre;
use App\Models\BookAuthor;
use App\Models\BookReading;
use App\Models\BookCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookEdit extends Component
{
    
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public
    $book,

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
        $this->book_readings[] = ['id' => null, 'start_date_table' => '', 'end_date_table' => ''];
    }
    public function removeBookReading($index)
    {
        if (!empty($this->book_readings[$index]['id'])) {
            BookReading::find($this->book_readings[$index]['id'])->delete();
        }

        unset($this->book_readings[$index]);
        $this->book_readings = array_values($this->book_readings); // Reindexar array
    }

    public function mount($uuid){

        $book = Book::where('uuid', $uuid)->first();
        $this->book = $book;

        $this->title = $book['title'];
        
        $this->original_title = $book['original_title'] ;
        $this->emission_status = $book['emission_status'] ;
        $this->format = $book['format'] ;
        $this->is_favorite = $book['is_favorite'] ? true : false;
        $this->is_wish = $book['is_wish'] ? true : false;

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

        $this->book_readings = $book->book_readings->map(function ($book_reading) {
            return [
                'id' => $book_reading->id,
                'book_id' => $book_reading->book_id,
                'user_id' => $book_reading->user_id,
                'start_date_table' => $book_reading->start_date,
                'end_date_table' => $book_reading->end_date,
            ];
        })->toArray();
    } 


    public function saveBook(){
        $this->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $this->slug = \Illuminate\Support\Str::slug($this->title);
        $this->rating = $this->rating == '' ? 0 : $this->rating;
        $this->number_collection = $this->number_collection == '' ? 1 : $this->number_collection;

        $this->is_favorite = $this->is_favorite == true ? 1 : 0;
        $this->is_wish = $this->is_wish == true ? 1 : 0;
        
        // validar form
        $validatedData = $this->validate();
        
        $this->book->update($validatedData);
        $this->book->book_genres()->sync($this->selected_book_genres);
        $this->book->book_tags()->sync($this->selected_book_tags);
        $this->book->book_authors()->sync($this->selected_book_authors);
        $this->book->book_collections()->sync($this->selected_book_collections);

        if ($this->book_readings) {
            foreach ($this->book_readings as $book_reading) {
                if ($book_reading['id']) {
                    BookReading::find($book_reading['id'])->update([
                        'start_date' => $book_reading['start_date_table'],
                        'end_date' => $book_reading['end_date_table'],
                    ]);
                } else {
                    BookReading::create([
                        'book_id' => $this->book->id,
                        'user_id' => Auth::user()->id,
                        'start_date' => $book_reading['start_date_table'],
                        'end_date' => $book_reading['end_date_table'],
                    ]);
                }
            }
        }

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
        $formats = Book::format();
        $emissions_status = Book::emission_status();

        return view('livewire.book.book-edit', compact(
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
