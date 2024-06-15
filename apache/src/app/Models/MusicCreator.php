<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicCreator extends Model
{
    
    protected $table = 'music_creators';
    protected $fillable = [
        'name',
        'local',
        'district',
        'duty',
        'birthday',
        'music_background',
        'designation',
    ];

    // Define relationships
    public function lyricistMusics()
    {
        return $this->belongsToMany(Music::class, 'music_lyricist', 'lyricist_id', 'music_id');
    }

    public function composerMusics()
    {
        return $this->belongsToMany(Music::class, 'music_composer', 'composer_id', 'music_id');
    }

    public function arrangerMusics()
    {
        return $this->belongsToMany(Music::class, 'music_arranger', 'arranger_id', 'music_id');
    }

      // Define relationship: MusicCreator has many musics
      public function musics()
      {
          return $this->hasMany(Music::class);
      }
}
