<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chanel extends Model {

    protected $fillable = ['name', 'description', 'youtube_id'];

    public function playlists() {
        return $this->hasMany(Playlist::class, 'chanel_id');
    }
    
    public function getplaylistsJsonAttribute() {
        $plsts = Playlist::where('chanel_id', $this->id)->get()->toJson();
        //$plsts = json_encode($plsts->toArray());
        return $plsts;
    }

}
