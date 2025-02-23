<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaActor extends Model
{
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

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_media_actor')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
