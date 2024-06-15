<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
    ];

    // Define relationship: Language has many musics
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
