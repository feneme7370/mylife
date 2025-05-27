<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraPhrase extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        
        'uuid',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public static function title()
    {
        return 'Extras 🔑';
    }
}
