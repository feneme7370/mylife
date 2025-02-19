<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCollection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function books()
    {
        return $this->hasMany(Book::class, 'book_collection_id', 'id');
    }
}
