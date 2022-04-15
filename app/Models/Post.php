<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'created_at',
        'num_comments',
        'num_shares',
        'num_likes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function userFollow()
//    {
//        return $this->belongsToMany(User::class)
//            ->wherePivotIn('id', [1, 2]);
//    }
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

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
