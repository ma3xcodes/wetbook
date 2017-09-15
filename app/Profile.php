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
        'cover_id',
        'public_folder'
    ];
    public function avatar()
    {
        return $this->hasOne(Photo::class, 'user_id', 'user_id')->where('is_avatar', true);
    }

    public function cover()
    {
        return $this->hasOne(Photo::class, 'user_id', 'user_id')->where('is_cover', true)->first();
    }

    public function lang()
    {
        //return $this->hasOne(Language::class);
        return Language::where('id',$this->language_id)->first();
    }
}
