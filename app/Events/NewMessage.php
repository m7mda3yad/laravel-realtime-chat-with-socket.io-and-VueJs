<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

 
    private $body;
    private $user_id;
    private $chat_id;
    
    public function __construct( $data)
    {
        $this->body = $data['body'];
        $this->user_id = $data['sender'];
        $this->chat_id = $data['chat_id'];
    }

  
    public function broadcastOn()
    {
      return new Channel('new-message');
    }

    public function broadcastWith()
    {
        return [
            'user_id'=>$this->user_id,
            'body'=>$this->body,
            'chat_id'=>$this->chat_id,
        ];
    }

     
}
