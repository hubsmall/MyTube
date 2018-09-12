<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    
    protected $fillable = ['name', 'youtube_id', 'chanel_id'];
    
    public function videos()
    {
        return $this->hasMany(Video::class, 'playlist_id');
    }

    public function chanel() {
        return $this->belongsTo(Chanel::class, 'chanel_id');
    }
}
