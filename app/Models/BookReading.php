<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReading extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'start_date',
        'end_date',
        'valoration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
