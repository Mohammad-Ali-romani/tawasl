<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $fillable = [
        'followed_id',
        'follower_id'
    ];
    public function userFollower(){
        return $this->belongsTo(User::class,'follower_id');
    }
    public function userFollowed(){
        return $this->belongsTo(User::class,'followed_id');
    }
}
