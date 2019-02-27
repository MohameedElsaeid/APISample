<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public function Session()
    {
        return $this->hasMany(Session::class);
    }
}
