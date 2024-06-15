<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicCategory extends Model
{

    protected $table = 'music_category'; // Specify the table name


    protected $fillable = ['name'];

    // Define the relationship with Music
    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
