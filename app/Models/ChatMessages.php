<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    use HasFactory;
     public function room(){
        return $this->hasOne('App\Model\ChatRoom','id','chat_room_id');
    }

    public function user(){
        return $this->hasOne('App\Model\User','id','user_id');
    }

    
}