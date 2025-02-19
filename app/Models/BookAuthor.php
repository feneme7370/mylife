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
        
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function books()
    {
        return $this->hasMany(Book::class, 'book_author_id', 'id');
    }
}
