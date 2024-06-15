<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicEnsembleType extends Model
{
    protected $fillable = ['name'];

    // Define the relationship with Music
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
