<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\DifInTime\DifInTime;

class Video extends Model
{
    protected $fillable = ['name', 'preview', 'playlist_id', 'description', 'player',  'tags', 'original_date', 'youtube_id'];
    
    public function playlist() {
        return $this->belongsTo(Section::class, 'playlist_id');
    }
    public function getDifInTimeAttribute() {
        return DifInTime::calculateDiff($this->original_date);
    }
}
