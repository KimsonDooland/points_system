<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    protected $fillable = [
        'user_id', 'points',
    ];
}
