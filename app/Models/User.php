<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'photo_id',
        'role_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Models\Photo');
    }

    public function isAdmin() {

        if($this->role->slug == 'admin' && $this->is_active == 1) {
            return true;
        }
        return false;
    }

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function defaultAvatar() {
        return "/images/def_avatar.png";
    }

    /**
    This is For Gravatar
        public function getGravatarAttribute() {
            $hash = md5(strtolower(trim($this->attributes['email']))) . '?d=mm';
            return "http://www.gravatar.com/avatar/$hash";
        }
     **/
}
