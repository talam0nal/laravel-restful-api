<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
	public $fillable = ['title', 'cover', 'text'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
