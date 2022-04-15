<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'avatar',
        'date_birth',
        'gender',
        'is_block',
        'num_posts',
        'num_followers',
        'num_followers_me',
        'country',
        'is_admin'
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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function secondComments()
    {
        return $this->hasMany(SecondComment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notifaction::class,'user_id');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function followeds()
    {
        return $this->hasMany(Follower::class, 'followed_id');
    }

    public function chat()
    {
        return $this->hasMany(Message::class);
    }

    public function senders()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function comsigners()
    {
        return $this->hasMany(Message::class, 'cosigner_id');
    }

    public function marshar()
    {
        return $this->hasMany(Chanter::class, 'marshar_id');
    }

    public function refered()
    {
        return $this->hasMany(Chanter::class, 'refered_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
