<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProduct;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Message;
use App\Rep\UserStatus;
use App\Events\SendMessage;
use App\Models\Product;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use UserStatus;

    public function file_test(NewProduct $request, Product $product)
    {
        if (!$product->countProductByName($request)) {
            $product->newProduct($request);
            return (!$product->countProductByName($request)) ?:'Done';
        }
        return 'Validate Error';
    }
    public function time()
    {
        return view('file_test');
        $product = \App\Models\Product::first();

        $now_time = Carbon::now();

        return ($product->created_at > $now_time->addMinutes(2))
            ? 'Your time is less than 2 minutes more than the current time.'.'Time Now(add 2 Minute)= '.$now_time.' My Time = '.Carbon::now()
            : 'Your time is more than 2 minutes longer than the current time.'.'Time Now(add 2 Minute)= '.$now_time.' My Time = '.Carbon::now();

    }
    private function status_message()
    {
        $id_users=[];
        if(auth()->check()){
            $status_profile = Message::where(['status' => 0 , 'user_get' => auth()->user()->id])->get('user_send');
            foreach($status_profile as $i)
            {
                array_push($id_users , $i->user_send);
            }
            return array_unique($id_users);
        }
    }
    public function index()
    {
        $users= User::where('id' , '!=' , auth()->user()->id)->latest('id')->get();
        $box_msg = false;
        $name= null;

        return view('welcome' , compact('users' , 'box_msg' , 'name'))->with(['user' => $this->user() , 'new_message' => $this->status_message()]);
    }

    public function editStatus(Request $request)
    {
        return ($request->status == 'online')
            ? $this->isOnline($request->user['id'])
            : $this->isOffline($request->user['id']);
    }

    public function showMessage(User $name)
    {
        $users= User::where('id' , '!=' , auth()->user()->id)->where('id', '!=' , $name->id)->latest('id')->get();
        $box_msg = true;
        $messages= Message::whereIn('user_send' , [auth()->user()->id,$name->id])->whereIn('user_get' , [auth()->user()->id,$name->id])->latest('id')->get();
        Message::whereIn('user_send' , [auth()->user()->id,$name->id])->whereIn('user_get' , [auth()->user()->id,$name->id])->update(['status'=>1 , 'view'=>1]);
        return view('welcome' , compact('users' , 'box_msg' , 'name' , 'messages'))->with(['user' => $this->user() , 'new_message' => $this->status_message()]);
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'body'=>$request->msg,
            'user_get'=>$request->user_get,
            'user_send'=>$request->user_send,
            'status' => 0,
            'user_id'=>auth()->user()->id,
            'view'=> 0
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
