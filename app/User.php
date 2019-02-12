<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;


    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'image'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getFirstNameAttribute($val)
    {
        return ucfirst($val);
    }


    public function getLastNameAttribute($val)
    {
        return ucfirst($val);
    }


    protected $appends = ['image_path'];


    public function getImagePathAttribute()
    {
        return asset('uploads/user_images/' . $this->image);
    }
}
