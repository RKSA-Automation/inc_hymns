<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnsembleType extends Model
{
    
    protected $table = 'ensemble_types';
    protected $fillable = [
        'name',
    ];

    // Define relationship: EnsembleType has many musics
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
