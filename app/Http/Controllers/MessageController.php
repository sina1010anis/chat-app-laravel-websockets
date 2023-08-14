<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rep\UserStatus;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use UserStatus;
    public function index()
    {
        $users= User::where('id' , '!=' , auth()->user()->id)->latest('id')->get();
        return view('welcome' , compact('users'));
    }

    public function editStatus(Request $request)
    {
        return ($request->status == 'online')
            ? $this->isOnline($request->user['id'])
            : $this->isOffline($request->user['id']);
    }

    public function show_message()
    {

    }
}
