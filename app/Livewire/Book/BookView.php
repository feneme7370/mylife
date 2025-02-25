<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;

class BookView extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public $book;

    public function mount($uuid){
        $this->book = Book::where('uuid', $uuid)->with('book_tags')->first();
    }

    public function render()
    {
        $type_content = Book::typeContent();
        $status_book = Book::statusBook();
        $valoration_stars = Book::valorationStars();


        return view('livewire.book.book-view', compact(
            'status_book',
            'valoration_stars',
        ));
    }
}
