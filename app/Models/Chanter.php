<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chanter extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        if ($this->type == 'comment')
            return $this->belongsTo(Comment::class);
        elseif ($this->type == 'post')
            return $this->belongsTo(Comment::class);
        return null;
    }
}
