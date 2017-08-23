<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','status'];
    public function object(){
        return $this->morphTo();
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'object_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
