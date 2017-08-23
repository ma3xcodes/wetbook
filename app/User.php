<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        //'middle_name',
        'last_name',
        'birthday',
        'email',
        'password',
        'status',
        'role'.
        'online'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($user){
            $public_folder = "users" . DS . uniqid(time()) . DS;
            \File::makeDirectory($public_folder, 0777);

            $photo = Photo::create([
                'user_id' => $user->id,
                'is_avatar' => true,
                'photo_origin' => 'assets/images/default-user.png',
                'photo_large' => 'assets/images/default-user.png',
                'photo_medium' => 'assets/images/default-user.png',
                'photo_small' => 'assets/images/default-user.png'
            ]);
            Profile::create([
                'user_id'   => $user->id,
                'photo_id'  => $photo->id,
                'public_folder' => $public_folder
            ]);

        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAgeAttribute()
    {
        $id = $this->id;
        $birth_time = strtotime($this->birthday);

        return Carbon::createFromDate(date('Y', $birth_time), date('m', $birth_time), date('d', $birth_time))->age;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get the profile record associated with the user.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'object');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function admin()
    {
        return $this->role=='admin'||$this->role=='s_admin';
    }
}
