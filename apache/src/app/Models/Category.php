<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = 'categories';
    protected $fillable = [
        'name',
    ];

    // Define relationship: Category has many musics
    public function musics()
    {
        return $this->belongsToMany(Music::class);
    }
}
