<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'preview', 'section_id', 'description', 'youtube_id'];
    
    public function section() {
        return $this->belongsTo(Section::class, 'section_id' , 'youtube_id');
    }
}
