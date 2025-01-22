<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShareDriverLocation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $datax;

    public function __construct($data)
    {
        $this->datax = $data;
    }
    public function broadcastOn()
    {
        return new Channel('driver.' . $this->datax['vehID']);
    }

    public function broadcastWith()
    {
        return $this->datax;
    
    }

    public function broadcastAs()
    {
        return 'DriverLocation';
    }
}
