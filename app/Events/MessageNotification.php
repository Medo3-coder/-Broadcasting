<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notification');

        // 1 - public Channel : any type of user can subscribe whether authenticated or not

        /* 2 - private Channel :
         Private channels require you to authorize that the currently
         authenticated user can actually listen on the channel. This is accomplished by making
         an HTTP request to your Laravel application with the channel
         name and allowing your application to determine if the user can listen on that channel.
         */

         /*
          3- Presence channels :
           build on the security of Private channels
           and expose the additional feature of an awareness of who is subscribed to that channel.
           This makes it extremely easy to build chat room and “who's online” type functionality to your application.
         */
    }
}
