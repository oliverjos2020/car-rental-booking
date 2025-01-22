<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Vehicle;

class DriverStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vehicleId;
    public $status;

    public function __construct($vehicleId, $status)
    {
        $this->vehicleId = $vehicleId;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('drivers');
    }

    public function broadcastAs()
    {
        return 'driver.status.changed';
    }
}
