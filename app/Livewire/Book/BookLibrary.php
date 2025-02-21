<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\BookAuthor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BookCollection;
use App\Models\BookTag;
use Illuminate\Support\Facades\Auth;

class BookLibrary extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book');}
    public function updatingStatusRead() {$this->resetPage(pageName: 'p_book');}
    public function updatingCollectionSelected() {$this->resetPage(pageName: 'p_book');}
    public function updatingAuthorSelected() {$this->resetPage(pageName: 'p_book');}
    public function updatingTagSelected() {$this->resetPage(pageName: 'p_book');}

    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 30, $status_read = "", $collection_selected, $author_selected, $tag_selected;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'status_read' => [ 'as' => 'r' ],
        'collection_selected' => [ 'as' => 'c' ],
        'author_selected' => [ 'as' => 'a' ],
        'tag_selected' => [ 'as' => 't' ],
        ];
    }

    // ordenar la tabla
    public function orderTable($column){
        if($this->sortBy != $column){
            $this->sortBy = $column;
        }else{
            $this->sortAsc = !$this->sortAsc;
        }
    }

    public function render()
    {
        $status_book = [1 => 'Quiero leer', 2 => 'Leído', 3 => 'Leyendo'];
        $book_collections = BookCollection::where('user_id', Auth::user()->id)->get();
        $book_authors = BookAuthor::where('user_id', Auth::user()->id)->get();
        $book_tags = BookTag::where('user_id', Auth::user()->id)->get();

        $books = Book::with(['user'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('title', 'like', '%'.$this->search . '%');
                // ->orWhereHas('book_collection', function ($q) {
                //     $q->where('name', 'like', '%'.$this->search . '%');
                // });
            });
        })
        ->when($this->status_read, function( $query) {
            return $query->where('status', $this->status_read);
        })
        ->when($this->tag_selected, function ($query) {
            $query->whereHas('book_tags', function ($q) {
                $q->where('book_tags.uuid', $this->tag_selected);
            });
        })
        ->when($this->author_selected, function ($query) {
            $query->whereHas('book_authors', function ($q) {
                $q->where('book_authors.uuid', $this->author_selected);
            });
        })
        ->when($this->collection_selected, function ($query) {
            $query->whereHas('book_collections', function ($q) {
                $q->where('book_collections.uuid', $this->collection_selected);
            });
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_book');

        return view('livewire.book.book-library', compact(
            'books',
            'status_book',
            'book_collections',
            'book_authors',
            'book_tags',
        ));
    }
}
