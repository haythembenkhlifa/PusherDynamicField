# Pusher Dynamic Field

Laravel Nova Pusher Dynamic Field

# Installation :

```sh
composer require haythem/pusher-dynamic-field
```

# How to use it :

create an event first

```php
        <?php

        namespace App\Events;

        use Illuminate\Queue\SerializesModels;
        use Illuminate\Broadcasting\PrivateChannel;
        use Illuminate\Foundation\Events\Dispatchable;
        use Illuminate\Broadcasting\InteractsWithSockets;
        use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

        class MyEvent implements ShouldBroadcast
        {
            use Dispatchable, InteractsWithSockets, SerializesModels;

            public $value;
            public $id;

            public function __construct($value,$id = 1)
            {
                $this->value = $value;
                $this->id = $id;

            }
            public function broadcastOn()
            {
                return new PrivateChannel('object.' . $this->id);
            }

            public function broadcastAs()
            {
                return 'my-event';
            }
        }

```

Add a channel in the channel.php file
 
```php
<?php

    Broadcast::channel('object.{id}', function ($user, $id) {
        return true;
    });

```

Add the field to your resource

```php

    PusherDynamicField::make("Pusher", function(){return "1";})
        ->pusherId("5fa5d6501def0291a52c")
        ->pusherCluster("mt1")
        ->badgesMap([ "5"=>"primary","1"=>"success", "2"=>"danger", "3"=>"warning", "4"=>"info","6"=>"#71504e"]) // if you need to make it a badge
        ->channelName("object.".$this->id),

```
