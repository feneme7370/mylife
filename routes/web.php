<?php

use App\Livewire\Book\BookAuthorList;
use App\Livewire\Book\BookCollectionList;
use App\Livewire\Book\BookCreate;
use App\Livewire\Book\BookDashboard;
use App\Livewire\Book\BookEdit;
use App\Livewire\Book\BookLibrary;
use App\Livewire\Book\BookList;
use App\Livewire\Book\BookTagList;
use App\Livewire\Book\BookView;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/book_dashboard', BookDashboard::class)->name('book_dashboard');
    Route::get('/book_create', BookCreate::class)->name('book_create');
    Route::get('/book_edit/{id}', BookEdit::class)->name('book_edit');
    Route::get('/book_library', BookLibrary::class)->name('book_library');
    Route::get('/book_list', BookList::class)->name('book_list');
    Route::get('/book_view/{uuid}', BookView::class)->name('book_view');

    Route::get('/book_author_list', BookAuthorList::class)->name('book_author_list');
    Route::get('/book_collection_list', BookCollectionList::class)->name('book_collection_list');
    Route::get('/book_tag_list', BookTagList::class)->name('book_tag_list');
});
