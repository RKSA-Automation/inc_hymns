<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'musics';
    protected $fillable = [
        'church_hymn_id',
        'title',
        'song_number',
        'music_score_path',
        'lyrics_path',
        'vocals_mp3_path',
        'organ_mp3_path',
        'preludes_mp3_path',
        'language_id',
        'verses_used',
        'created_by',
        'updated_by',
        'lyrics'
    ];

    // Define relationships
    public function churchHymn()
    {
        return $this->belongsTo(ChurchHymn::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'music_category', 'music_id', 'category_id');
    }

    public function instrumentations()
    {
        return $this->belongsToMany(Instrumentation::class, 'music_instrumentation', 'music_id', 'instrumentation_id');
    }

    public function ensembleTypes()
    {
        return $this->belongsToMany(EnsembleType::class, 'music_ensemble_type', 'music_id', 'ensemble_type_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function lyricists()
    {
        return $this->belongsToMany(MusicCreator::class, 'music_lyricist', 'music_id', 'lyricist_id');
    }

    public function composers()
    {
        return $this->belongsToMany(MusicCreator::class, 'music_composer', 'music_id', 'composer_id');
    }

    public function arrangers()
    {
        return $this->belongsToMany(MusicCreator::class, 'music_arranger', 'music_id', 'arranger_id');
    }

    public function musicCreators()
    {
        return $this->belongsToMany(MusicCreator::class);
    }
    
}
