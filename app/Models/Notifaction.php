<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'link',
        'is_old',
        'subject_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userNotifa()
    {
        return $this->belongsTo(User::class,'subject_id');
    }
}
