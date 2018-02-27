<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\UserPoints;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_points()
    {
        return $this->hasOne('\App\UserPoints', 'user_id', 'id');
    }
    public function user_refs()
    {
        return $this->hasMany('\App\UserRef', 'main_user_id', 'id');
    }
}
