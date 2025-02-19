<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookView extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public $book;

    public function mount($uuid){
        $this->book = Book::where('uuid', $uuid)->first();
    }

    public function render()
    {
        $statusBook = [1 => 'Quiero leer', 2 => 'Leído', 3 => 'Leyendo'];
        $valoration_stars = [1 => '⭐', 2 => '⭐⭐', 3 => '⭐⭐⭐', 4 => '⭐⭐⭐⭐', 5 => '⭐⭐⭐⭐⭐'];

        return view('livewire.book.book-view', compact(
            'statusBook',
            'valoration_stars',
        ));
    }
}
