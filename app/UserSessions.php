<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSessions extends Model
{
    protected $fillable = [
        'user_id','session_id'
    ];
}
