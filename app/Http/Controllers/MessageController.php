<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Message;
use App\Rep\UserStatus;
use App\Events\SendMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use UserStatus;


    public function index()
    {
        $users= User::where('id' , '!=' , auth()->user()->id)->latest('id')->get();
        $box_msg = false;
        $name= null;
        return view('welcome' , compact('users' , 'box_msg' , 'name'))->with(['user' => $this->user()]);
    }

    public function editStatus(Request $request)
    {
        return ($request->status == 'online')
            ? $this->isOnline($request->user['id'])
            : $this->isOffline($request->user['id']);
    }

    public function showMessage(User $name)
    {
        $users= User::where('id' , '!=' , auth()->user()->id)->latest('id')->get();
        $box_msg = true;
        $messages= Message::whereIn('user_send' , [auth()->user()->id,$name->id])->whereIn('user_get' , [auth()->user()->id,$name->id])->latest('id')->get();
        return view('welcome' , compact('users' , 'box_msg' , 'name' , 'messages'))->with(['user' => $this->user()]);
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'body'=>$request->msg,
            'user_get'=>$request->user_get,
            'user_send'=>$request->user_send,
            'user_id'=>auth()->user()->id,
        ]);
        event(new SendMessage($request->msg , $request->user_send , $request->user_get , auth()->user()->id));
        return [
            'body' => $request->msg,
            'user_send' => $request->user_send,
            'user_get' => $request->user_get,
            'user_id' =>  auth()->user()->id,
            'created_at' => Carbon::now(),
        ];
    }
    public function user()
    {
        return (auth()->check()) ? auth()->user() : null ;
    }
}
