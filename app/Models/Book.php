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
        // 'book_author_id',
        'synopsis',
        'release_date',
        'start_date',
        'end_date',

        // 'book_collection_id',
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
}