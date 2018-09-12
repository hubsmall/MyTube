<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chanel extends Model
{
    protected $fillable = ['name', 'description', 'youtube_id'];
    

    public function playlists()
    {
        return $this->hasMany(Video::class, 'chanel_id');
    }
}
