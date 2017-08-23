<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citie extends Model
{
    protected $fillable = [
        'country',
        'region',
        'region',
        'name',
        'latitude',
        'longitude',
    ];
}
