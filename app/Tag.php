<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function publication()
    {
        return $this->belongsToMany('App\Publication');
    }
}
