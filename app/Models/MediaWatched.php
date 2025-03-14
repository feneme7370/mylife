<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaWatched extends Model
{
    protected $fillable = [
        'media_id',
        'user_id',
        'start_date',
        'end_date',
        'valoration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
