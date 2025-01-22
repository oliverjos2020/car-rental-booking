<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RideAccepted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rideRequest;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($rideRequest)
    {
        $this->rideRequest = $rideRequest;

    }

    public function broadcastWith()
    {
        return [
            'pickupLocation' => $this->rideRequest->originCoords,
            'dropoffLocation' => $this->rideRequest->destinationCoords,
            'vehId' => $this->rideRequest->vehicle_id,
            'status' => $this->rideRequest->is_request_accepted
        ];
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

     public function broadcastOn()
     {
        // dd($this->rideRequest);
         return new Channel('user.' . $this->rideRequest->user_id);
     }

    public function broadcastAs()
    {
        return 'RideAccepted';
    }

}
