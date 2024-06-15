<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchHymn extends Model
{
    
    protected $table = 'church_hymns';
    protected $fillable = [
        'name',
    ];

    // Define relationship: ChurchHymn has many musics
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
