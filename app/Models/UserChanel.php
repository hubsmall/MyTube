<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserChanel extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = ['login', 'description', 'mytube_id', 'email', 'password'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    public function userPlaylists()
    {
        return $this->hasMany(UserVideo::class, 'userChanel_id');
    }
}
