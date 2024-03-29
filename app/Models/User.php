<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback', 'questioner_id');
    }

    public function views()
    {
        return $this->hasMany('App\Models\PostView', 'user_id');
    }
}
