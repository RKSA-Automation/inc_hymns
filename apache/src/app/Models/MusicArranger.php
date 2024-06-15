<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicArranger extends Model
{
    protected $table = 'music_arranger'; // Specify the table name

    protected $fillable = [
        'music_id',
        'arranger_id',
    ];

    // No need for timestamps in pivot table
    public $timestamps = false;
}
