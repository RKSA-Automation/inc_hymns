<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrumentation extends Model
{
    protected $table = 'instrumentations';
    protected $fillable = [
        'name',
    ];

    // Define relationship: Instrumentation has many musics
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
