<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'name', 'duration', 'creators', 'rate', 'synopsis', 'image'
    ];
}
