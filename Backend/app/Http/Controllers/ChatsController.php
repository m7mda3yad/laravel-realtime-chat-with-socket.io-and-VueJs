<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewMessage;
use App\Events\NewNotification;

class ChatsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $users = User::whereNotIn('id',[auth()->user()->id])->paginate(10);
        return view('chats.index',compact('users'));
    }
    public function show($id)
    {
        $chat = Chat::where('user_1',auth()->user()->id)->where('user_2',$id)->first();
        if($chat==null)
        $chat = Chat::where('user_2',auth()->user()->id)->where('user_1',$id)->first();
        if($chat==null)
        $chat = Chat::create(['user_1'=>auth()->user()->id,'user_2'=>$id]);
        $user  = User::findOrFail($id);
        $users = User::whereNotIn('id',[auth()->user()->id])->paginate(10);
        return view('chats.show',compact('user','users','chat'));
    }

    public function postStore(Request $request)
    {
        $user = User::find($request->user_id);
        $comment=Comment::create($request->all());
        $data =[
            'user_id' => $user->id,
            'user_name'  => $user->name,
            'body' => $request->body,
            'post_id' =>$request->post_id ,
       ];
        event(new NewNotification($data));
              
            return response()->json(['success'=>'add successful']);  
    }
    public function messageStore(Request $request)
    {
        $data =[
            'sender' => $request->user_id,
            'body' => $request->body,
            'chat_id' =>$request->chat_id ,
       ];
        $comment=Message::create($data);
        event(new NewMessage($data));
              
            return response()->json(['success'=>'add successful']);  
    }
}
