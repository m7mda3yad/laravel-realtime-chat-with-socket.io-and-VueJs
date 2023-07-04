<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\NewNotification;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function posts()
    {
        return view('posts');
    }
    public function chats()
    {
        return view('chats');
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
}
