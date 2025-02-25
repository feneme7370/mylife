<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image_url',
        'uuid',
        'user_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_book_genre')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
