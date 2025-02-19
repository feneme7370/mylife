<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Models\BookCollection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BookList extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingSearch() {$this->resetPage(pageName: 'p_book');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_book');}
    public function updatingStatusRead() {$this->resetPage(pageName: 'p_book');}
    public function updatingCollectionSelected() {$this->resetPage(pageName: 'p_book');}

    // propiedades de busqueda
    public $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10, $status_read, $collection_selected;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'status_read' => [ 'as' => 'r' ],
        'collection_selected' => [ 'as' => 'c' ],
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
        $statusBook = [1 => 'Quiero leer', 2 => 'Leído', 3 => 'Leyendo'];
        $collections = BookCollection::where('user_id', Auth::user()->id)->get();
        $books = Book::with(['user', 'book_author', 'book_collection'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('title', 'like', '%'.$this->search . '%')
                ->orWhereHas('book_author', function ($q) {
                    $q->where('name', 'like', '%'.$this->search . '%');
                })
                ->orWhereHas('book_collection', function ($q) {
                    $q->where('name', 'like', '%'.$this->search . '%');
                });
            });
        })
        ->when($this->status_read, function( $query) {
            return $query->where('status', $this->status_read);
        })
        ->when($this->collection_selected, function( $query) {
            return $query->where('book_collection_id', $this->collection_selected);
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_book');

        return view('livewire.book.book-list', compact(
            'books',
            'statusBook',
            'collections',
        ));
    }
}
