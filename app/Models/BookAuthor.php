<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookAuthor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'birthdate', 
        'description', 
        'country',
        'cover_image_url',
        'uuid',
        'user_id',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_book_author')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
