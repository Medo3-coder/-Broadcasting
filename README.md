# -Broadcasting


Introduction
1- Setting up our Broadcast

run :
 - composer require pusher/pusher-php-server


2- Setting up Pusher API
  -make account in pusher.com
  -use channenls
  -create new app and chouse cluster near to me and frontend and backend technology
  -in menu -> App keys use this cerdintials in env file to make sure you can interact to pusher 
     ```ruby
    PUSHER_APP_ID=1292643
    PUSHER_APP_KEY=bdd71b297e8d2ac2d0a1
    PUSHER_APP_SECRET=7b7d92a80775e19f986c
    PUSHER_APP_CLUSTER=eu

    ```

  - change the driver to    ```   BROADCAST_DRIVER=pusher   ```





  - create Broadcasting event 

  - use  ```php artisan make:event MessageNotification``` 
  -inside event -> MessageNotification

  ```ruby

 


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
    }
}


  ```


   - i have three type of channels 

   1 - public Channel :
          any type of user can subscribe whether authenticated or not

   2 - private Channel :
         Private channels require you to authorize that the currently
         authenticated user can actually listen on the channel. This is accomplished by making
         an HTTP request to your Laravel application with the channel
         name and allowing your application to determine if the user can listen on that channel.


    3- Presence channels : 
           build on the security of Private channels
           and expose the additional feature of an awareness of who is subscribed to that channel.
           This makes it extremely easy to build chat room and “who's online” type functionality to your application.



   - go config -> app.php in 'providers' and uncomment this   
    
   ```  
   App\Providers\BroadcastServiceProvider::class, 
   ```

   
 
 3-  Creating our broadcasting flow

     installing laravel Echo 

   - laravel Echo : is advanced framework feature with js package reduces the amount of code to write 
                   is a JavaScript library that makes it painless to subscribe to channels and listen for events broadcast
                   by your server-side broadcasting driver.

  - ```use : npm install pusher-js laravel-echo --save```


 4 -  Uncomment the Broadcast provider


 5 - Setting up the routes

```ruby

// to fire event
Route::get('/event', function () {
    event(new MessageNotification('this my first broadcast message !'));
});

// to listen to event

Route::get('/listen', function () {
    return view('listen');
});

```

- in resources folder -> view ->  create new file : listen.blade.php

 - don't forget to use 
```ruby 
    <meta name="csrf-token" content="{{ csrf_token() }}">

<body>
    <div id="app">

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>
```

- in resources folder -> bootstrap.js and uncomment this code 

```ruby

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

```

 - run : compser require laravel ui

 - composer require laravel  ui vue 


 - inside app.js 

```ruby 

const app = new Vue({
    el: '#app',
    created() {
        Echo.channel('notification')
            .listen('MessageNotification', (e) => {
                console.log('Welp , this Showed up without a refresh!');
            });
    }
});

```

 - run npm run watch 




 Registering the channel
 Testing it out in the browser
