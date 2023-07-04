<?php

namespace App\Events;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user_id;
    public $body;
    public $user_name;
    public $post_id;
    public $date;
    public $time;

    public function __construct($data = [])
    {
        $this->user_id = $data['user_id'];
        $this->user_name = $data['user_name'];
        $this->body = $data['body'];
        $this->post_id = $data['post_id'];
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));
    }

    public function broadcastOn()
    {
      return new Channel('new-notification');
    }
    public function broadcastWith()
    {
        return [

            'user_id'=>$this->user_id,
            'user_name'=>$this->user_name,
            'body'=>$this->body,
            'post_id'=>$this->post_id,
            'date'=>$this->date,
            'time'=>$this->time
        ];
    }
}
