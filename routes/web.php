<?php

use App\Livewire\Book\BookAuthorList;
use App\Livewire\Book\BookCollectionList;
use App\Livewire\Book\BookCreate;
use App\Livewire\Book\BookDashboard;
use App\Livewire\Book\BookEdit;
use App\Livewire\Book\BookGenreList;
use App\Livewire\Book\BookLibrary;
use App\Livewire\Book\BookList;
use App\Livewire\Book\BookTagList;
use App\Livewire\Book\BookView;
use App\Livewire\Dashboard;
use App\Livewire\Extra\ExtraDashboard;
use App\Livewire\Extra\ExtraPhraseList;
use App\Livewire\Media\MediaActorList;
use App\Livewire\Media\MediaCollectionList;
use App\Livewire\Media\MediaCreate;
use App\Livewire\Media\MediaDashboard;
use App\Livewire\Media\MediaDirectorList;
use App\Livewire\Media\MediaEdit;
use App\Livewire\Media\MediaGenreList;
use App\Livewire\Media\MediaLibrary;
use App\Livewire\Media\MediaList;
use App\Livewire\Media\MediaTagList;
use App\Livewire\Media\MediaView;

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

    // libros
    Route::get('/book_dashboard', BookDashboard::class)->name('book_dashboard');
    Route::get('/book_create', BookCreate::class)->name('book_create');
    Route::get('/book_edit/{uuid}', BookEdit::class)->name('book_edit');
    Route::get('/book_library', BookLibrary::class)->name('book_library');
    Route::get('/book_list', BookList::class)->name('book_list');
    Route::get('/book_view/{uuid}', BookView::class)->name('book_view');

    Route::get('/book_genre_list', BookGenreList::class)->name('book_genre_list');
    Route::get('/book_author_list', BookAuthorList::class)->name('book_author_list');
    Route::get('/book_collection_list', BookCollectionList::class)->name('book_collection_list');
    Route::get('/book_tag_list', BookTagList::class)->name('book_tag_list');

    // media
    Route::get('/media_dashboard', MediaDashboard::class)->name('media_dashboard');
    Route::get('/media_create/{type}', MediaCreate::class)->name('media_create');
    Route::get('/media_edit/{type}/{uuid}', MediaEdit::class)->name('media_edit');
    Route::get('/media_library', MediaLibrary::class)->name('media_library');
    Route::get('/media_list', MediaList::class)->name('media_list');
    Route::get('/media_view/{uuid}', MediaView::class)->name('media_view');

    Route::get('/media_genre_list', MediaGenreList::class)->name('media_genre_list');
    Route::get('/media_actor_list', MediaActorList::class)->name('media_actor_list');
    Route::get('/media_director_list', MediaDirectorList::class)->name('media_director_list');
    Route::get('/media_collection_list', MediaCollectionList::class)->name('media_collection_list');
    Route::get('/media_tag_list', MediaTagList::class)->name('media_tag_list');

    // extras
    Route::get('/extra_dashboard', ExtraDashboard::class)->name('extra_dashboard');
    Route::get('/extra_phrase_list', ExtraPhraseList::class)->name('extra_phrase_list');
});
