<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_send',
        'user_get',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
