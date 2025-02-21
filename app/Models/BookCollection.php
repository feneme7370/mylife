<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCollection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        
        'uuid',
        'user_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_book_collection')
                    ->withTimestamps();
    }
}
