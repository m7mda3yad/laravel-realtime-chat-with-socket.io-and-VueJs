<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id', 'sender', 'body'];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }
    public function chat()
    {
        return $this->belongsTo(User::class);
    }

}
