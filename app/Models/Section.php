<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Section extends Model
{
    use NodeTrait;
    
    protected $fillable = ['name', 'youtube_id', 'parent_id', '_lft', '_rgt'];
    
    public function videos()
    {
        return $this->hasMany(Video::class, 'section_id', 'youtube_id');
    }
}
