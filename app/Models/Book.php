<?php

namespace App\Models;

use App\Models\User;
use App\Models\BookTag;
use App\Models\BookAuthor;
use App\Models\BookCollection;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'release_date',
        'start_date',
        'end_date',

        'media_type',
        'number_collection',

        'pages',
        'rating',
        'personal_description',

        'cover_image',
        'cover_image_url',

        'status',
        
        'uuid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book_tags()
    {
        return $this->belongsToMany(BookTag::class, 'book_book_tag')
                    ->withTimestamps();
    }
    public function book_authors()
    {
        return $this->belongsToMany(BookAuthor::class, 'book_book_author')
                    ->withTimestamps();
    }
    public function book_collections()
    {
        return $this->belongsToMany(BookCollection::class, 'book_book_collection')
                    ->withTimestamps();
    }
    public function book_genres()
    {
        return $this->belongsToMany(BookGenre::class, 'book_book_genre')
                    ->withTimestamps();
    }


    public static function valorationStars()
    {
        return [0 => 'Sin Valoracion', 1 => '⭐', 2 => '⭐⭐', 3 => '⭐⭐⭐', 4 => '⭐⭐⭐⭐', 5 => '⭐⭐⭐⭐⭐'];
    }
    public static function typeContent()
    {
        return [1 => 'Libro', 2 => 'Manga'];
    }
    public static function statusBook()
    {
        return [1 => 'Quiero leer', 2 => 'Leído', 3 => 'Leyendo'];
    }
    public static function title()
    {
        return 'Biblioteca';
    }
}