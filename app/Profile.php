<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'privacy',
        'rating',
        'about_me',
        'relatinship',
        'looking_for',
        'phone',
        'interests',
        'education',
        'hobbies',
        'language_id',
        'fav_movies',
        'fav_artists',
        'fav_books',
        'fav_animals',
        'religion',
        'photo_id',
        'public_folder'
    ];
    public function avatar()
    {
        return $this->hasOne(Photo::class, 'user_id', 'user_id')->where('is_avatar', true);
    }//
}
