<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaSeason extends Model
{
    use HasFactory;

    protected $fillable = ['media_id', 'title', 'episodes_count', 'description'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
