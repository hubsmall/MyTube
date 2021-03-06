<?php

namespace App\Models;

set_time_limit(0);

use Illuminate\Database\Eloquent\Model;
use App\DifInTime\DifInTime;
use Carbon\Carbon;

class Video extends Model
{ 
    protected $fillable = ['name', 'preview', 'playlist_id', 'description', 'player',  'tags', 'original_date', 'youtube_id'];
    
    public function playlist() {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }
    public function getDifInTimeAttribute() {
        return DifInTime::calculateDiff($this->original_date);
    }
    public function getDifInTimeCarbonAttribute() {
    	Carbon::setLocale('ru');
    	$dt = Carbon::createFromFormat('Y-m-d H:i:s', $this->original_date); 
        return $dt->diffForHumans();
    }
    public function getDateNoTimeCarbonAttribute() {
        return date('d-m-Y', strtotime($this->original_date));
    }
    
}
