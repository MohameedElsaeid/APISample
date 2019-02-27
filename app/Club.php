<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function sports()
    {
        return $this->hasMany(Sport::class);
    }
}
