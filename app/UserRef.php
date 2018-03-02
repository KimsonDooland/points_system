<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserRef extends Model
{
    protected $fillable = [
        'main_user_id', 'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo('\App\User','main_user_id');
    }
}
