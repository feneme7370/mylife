<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'book_author_id',
        'synopsis',
        'release_date',
        'start_date',
        'end_date',

        'book_collection_id',
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
    public function book_collection()
    {
        return $this->belongsTo(BookCollection::class, 'book_collection_id', 'id');
    }
    public function book_author()
    {
        return $this->belongsTo(BookAuthor::class, 'book_author_id', 'id');
    }
    public function book_tags()
    {
        return $this->belongsToMany(BookTag::class, 'book_book_tag')
                    ->withTimestamps();
    }
}