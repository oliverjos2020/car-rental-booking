<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DriverAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rideRequest;

    public function __construct($rideRequest)
    {
        $this->rideRequest = $rideRequest;
    }

    public function broadcastWith()
    {
        // print_r($this->rideRequest);
        // exit;
        return $this->rideRequest;
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        return [
            'vehicleId' => $this->rideRequest->vehicleId,
            'rideId' => $this->rideRequest->id,
            // Add more relevant details
            'pickupLocation' => $this->rideRequest->originCoords,
            'dropoffLocation' => $this->rideRequest->destinationCoords,
            'user' => $user
            // Add any other necessary ride details
        ];
    }


    public function broadcastOn()
    {
        return new Channel('vehicle.' . $this->rideRequest['vehicleId']);
    }

    public function broadcastAs()
    {
        return 'BookedRide';
    }
}
