<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookTag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'user_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_book_tag')
                    ->withTimestamps();
    }
}
