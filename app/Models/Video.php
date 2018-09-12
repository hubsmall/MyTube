<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'preview', 'playlist_id', 'description', 'youtube_id'];
    
    public function playlist() {
        return $this->belongsTo(Section::class, 'playlist_id');
    }
}
