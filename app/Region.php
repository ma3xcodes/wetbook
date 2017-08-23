<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $fillable = [
        'country',
        'code',
        'name',
        'latitude',
        'longitude',
        'cities',
    ];
}
