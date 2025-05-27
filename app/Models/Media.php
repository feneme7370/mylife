<?php

namespace App\Models;

use App\Models\MediaSeason;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'title',
        'slug',

        'original_title',
        'emission_status',
        'format',
        'is_favorite',
        'is_wish',

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
    public function media_genres()
    {
        return $this->belongsToMany(MediaGenre::class, 'media_media_genre')
                    ->withTimestamps();
    }
    public function seasons()
    {
        return $this->hasMany(MediaSeason::class);
    }

    public function media_watcheds()
    {
        return $this->HasMany(MediaWatched::class);
    }




    public static function valorationStars()
    {
        return [
            0 => 'Sin Valoracion', 
            1 => '⭐', 
            2 => '⭐⭐', 
            3 => '⭐⭐⭐', 
            4 => '⭐⭐⭐⭐', 
            5 => '⭐⭐⭐⭐⭐'
        ];
    }
    public static function typeContent()
    {
        return [
            1 => '🎬 Película', 
            2 => '📺 Serie'
        ];
    }
    
    public static function statusMedia()
    {
        return [
            1 => '🎯 Quiero ver', 
            2 => '✅ Visto', 
            3 => '📽️ Viendo', 
            4 => '🔁 Re-vista', 
            5 => '🚫 Abandonada'
        ];
    }
    
    public static function format()
    {
        return [
            1 => '📡 TV', 
            2 => '🎭 Cine'
        ];
    }
    
    public static function emission_status()
    {
        return [
            1 => '🏁 Finalizada', 
            2 => '📡 En emisión', 
            3 => '❌ Cancelada'
        ];
    }
    
    public static function title()
    {
        return 'Cine y TV 🎥';
    }
    
}
