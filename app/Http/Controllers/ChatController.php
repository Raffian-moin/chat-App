<?php

namespace App\Http\Controllers;

use App\Models\ChatMessages;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ChatController extends Controller
{
    public function rooms(){
    	return ChatRoom::all();
    }


    public function messages(Request $request,$roomid){
    	return ChatMessages::where('chat_room_id',$roomid)
    	->with('user')
    	->orderBy('created_at','DESC')
    	->get();
    }


    public function NewMessage(Request $request,$roomid){

    	$NewMessage=new ChatMessages;

    	$NewMessage->user_id=Auth::id();
    	$NewMessage->chat_room_id=$roomid;
    	$NewMessage->message=$request->message;

    	$NewMessage->save();

    	return $NewMessage;


    }
}
