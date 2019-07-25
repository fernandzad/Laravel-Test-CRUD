<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
	public $table = "movies_genres";
    public $timestamps = false;
    protected $fillable = [
        'idMovie', 'idGenre'
    ];
}
