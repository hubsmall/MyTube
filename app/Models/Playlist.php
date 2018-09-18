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

    public function getLimitedVideosAttribute()
    {
        return Video::where('playlist_id', $this->id)
        	   ->orderBy('original_date', 'desc')
               ->take(2)
               ->get();
    }

    public function chanel() {
        return $this->belongsTo(Chanel::class, 'chanel_id');
    }
}
