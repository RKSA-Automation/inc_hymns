<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicLyricist extends Model
{
    protected $table = 'music_lyricist'; // Specify the table name

    protected $fillable = [
        'music_id',
        'lyricist_id',
    ];

    // No need for timestamps in pivot table
    public $timestamps = false;
}
