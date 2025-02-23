<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'release_date',

        'number_collection',
        'duration',
        'rating',
        'personal_description',

        'media_type',

        'start_date',
        'end_date',

        'cover_image',
        'cover_image_url',

        'status',
        
        'uuid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function media_tags()
    {
        return $this->belongsToMany(MediaTag::class, 'media_media_tag')
                    ->withTimestamps();
    }
    public function media_directors()
    {
        return $this->belongsToMany(MediaDirector::class, 'media_media_director')
                    ->withTimestamps();
    }
    public function media_actors()
    {
        return $this->belongsToMany(MediaActor::class, 'media_media_actor')
                    ->withTimestamps();
    }
    public function media_collections()
    {
        return $this->belongsToMany(MediaCollection::class, 'media_media_collection')
                    ->withTimestamps();
    }




    public static function valorationStars()
    {
        return [1 => '⭐', 2 => '⭐⭐', 3 => '⭐⭐⭐', 4 => '⭐⭐⭐⭐', 5 => '⭐⭐⭐⭐⭐'];
    }
    public static function typeContent()
    {
        return [1 => 'Pelicula', 2 => 'Serie', 3 => 'Anime'];
    }
    public static function statusMedia()
    {
        return [1 => 'Quiero ver', 2 => 'Visto', 3 => 'Viendo'];
    }
}
