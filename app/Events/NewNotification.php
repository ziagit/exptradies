<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $toUser;
    public $fromUser;
    public $notificationId;
    public $type;
    public $title;
    /**
     * Create a new event instance. 
     *
     * @return void
     */
    public function __construct($fromUser, $toUser, $notification, $type, $title)
    {
        $this->toUser = $toUser;
        $this->fromUser = $fromUser;
        $this->notificationId = $notification;
        $this->type = $type;
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification.' . $this->toUser);
    }

    public function broadcastAs()
    {
        return 'notification-event';
    }
}
