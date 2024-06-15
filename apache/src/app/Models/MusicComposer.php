<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicComposer extends Model
{
    protected $table = 'music_composer'; // Specify the table name

    protected $fillable = [
        'music_id',
        'composer_id',
    ];

    // No need for timestamps in pivot table
    public $timestamps = false;
}
