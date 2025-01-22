<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\RideOrder;
use App\Events\RideAccepted;
use Illuminate\Http\Request;
use App\Events\DriverAssigned;
use Illuminate\Support\Facades\DB;
use App\Events\DriverStatusChanged;
use App\Events\ShareDriverLocation;
use Illuminate\Support\Facades\Auth;
use App\Events\DriverLocationUpdated;
use Illuminate\Support\Facades\Broadcast;

class DriverController extends Controller
{


    public function getNearbyDrivers(Request $request)
    {
        $request->validate([
            'origin_lat' => 'required|numeric',
            'origin_lng' => 'required|numeric',
            'destination_lat' => 'required|numeric',
            'destination_lng' => 'required|numeric',
        ]);

        // Get input values
        $originLat = $request->input('origin_lat');
        $originLng = $request->input('origin_lng');
        $destinationLat = $request->input('destination_lat');
        $destinationLng = $request->input('destination_lng');

        // Define the radius in kilometers
        $radius = 50;

        // Query for nearby drivers within the specified radius
        // $drivers = \DB::table('vehicles')
        //     ->selectRaw("id, name, latitude, longitude, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$originLat, $originLng, $originLat])
        //     ->having('distance', '<', $radius)
        //     ->orderBy('distance')
        //     ->get();
        $drivers = \DB::table('vehicles')
        ->join('users', 'vehicles.user_id', '=', 'users.id')
        ->selectRaw("vehicles.id, users.name, vehicles.latitude, vehicles.longitude, (6371 * acos(cos(radians(?)) * cos(radians(vehicles.latitude)) * cos(radians(vehicles.longitude) - radians(?)) + sin(radians(?)) * sin(radians(vehicles.latitude)))) AS distance", [$originLat, $originLng, $originLat])
        ->having('distance', '<', $radius)->where('on_trip', 0)
        ->orderBy('distance')
        ->get();

        foreach ($drivers as $driver) {
            $driver->distance = $this->calculateDistance($originLat, $originLng, $driver->latitude, $driver->longitude);
        }

        return response()->json(['drivers' => $drivers]);
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        // Ensure all values are numeric
        if (!is_numeric($lat1) || !is_numeric($lng1) || !is_numeric($lat2) || !is_numeric($lng2)) {
            \Log::error('Non-numeric values encountered:', compact('lat1', 'lng1', 'lat2', 'lng2'));
            return null; // or handle the error as needed
        }

        // Calculate the distance between two coordinates (Haversine formula)
        $earthRadius = 6371; // Earth radius in km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    // public function toggleStatus(Request $request)
    // {
    //     // Validate the incoming data
    //     $validated = $request->validate([
    //         'status' => 'required|in:0,1',  // Ensure the status is either 0 or 1
    //     ]);

    //     $vehicle = Vehicle::where('id', 25)->first(); // Replace with dynamic vehicle ID if needed

    //     if (!$vehicle) {
    //         return response()->json(['error' => 'Vehicle not found'], 404);
    //     }

    //     // Update the vehicle's status
    //     $vehicle->is_online = $validated['status'];
    //     $vehicle->save();

    //     // Broadcast the status change event to update other users (e.g., riders)
    //     broadcast(new \App\Events\DriverStatusChanged($vehicle));

    //     // Return the updated status
    //     return response()->json([
    //         'status' => $vehicle->is_online,  // Return the updated status of the vehicle
    //         'message' => 'Vehicle status updated successfully'
    //     ]);
    // }


    //Experimental
    public function toggleStatus(Request $request)
    {
        $vehicle = Vehicle::find($request->vehID);

        if ($vehicle) {
            $vehicle->is_online = $request->status;
            $vehicle->save();

            // Broadcast event
            broadcast(new DriverStatusChanged($vehicle->id, $vehicle->is_online));

            return response()->json(['message' => 'Vehicle status updated successfully']);
        }

        return response()->json(['message' => 'Vehicle not found'], 404);
    }

    public function requestRide(Request $request)
    {
        $rideRequest = RideOrder::create([
            'originCoords' => json_encode($request->pickup, true),
            'destinationCoords' => json_encode($request->dropoff, true),
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->user()->id,
            'amount'  => 100,
            'driver_id' => 1
        ]);

        return response()->json(['success' => true, 'rideRequest' => $rideRequest]);
    }


    public function getNearbyVehicles(Request $request)
    {
        // Retrieve the coordinates from the request
        $user_lat = $request->input('origin_lat');  // User's latitude
        $user_lng = $request->input('origin_lng');  // User's longitude
        $radius = 5;  // 5 km radius

        $vehicles = DB::table('vehicles')->select('id', 'vehicleMake', 'vehicleModel', 'latitude', 'longitude',
        DB::raw('(6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )) AS distance')
    )
        ->addBinding([$user_lat, $user_lng, $user_lat], 'select')
        ->where('is_online', '1')
        ->where('on_trip', '0')
        ->whereRaw('(6371 * acos(
            cos(radians(?)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) * sin(radians(latitude))
        )) <= ?', [$user_lat, $user_lng, $user_lat, $radius])
        ->orderBy('distance', 'asc')
        ->get();


        // Return the vehicles as JSON response
        return response()->json([
            'success' => true,
            'vehicles' => $vehicles
        ]);
    }

    public function selectVehicle(Request $request)
    {
        $rideRequest = RideOrder::find($request->rideId);

        // Ensure the ride request exists
        if (!$rideRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Ride request not found!'
            ], 404);
        }

        $rideRequest->vehicle_id = $request->vehicleId;
        $rideRequest->is_request_accepted = 1;
        $rideRequest->save();
        $id = auth()->user()->id;
        $user = User::select('name', 'phone_no', 'address')->where('id', $id)->first();
        $rideData = [
            'vehicleId' => $request->vehicleId,
            'rideId' => $request->rideId,
            'pickupLocation' => $rideRequest->originCoords,
            'dropoffLocation' => $rideRequest->destinationCoords,
            'distance' => $request->distance,
            'price' => $request->price,
            'user' => $user
        ];

        $options = ['cluster' => 'eu', 'useTLS' => true];
        $pusher = new Pusher('62fa54aa1df62c15f35a', '89e95c86baf51c9a03e8', '1904582', $options);

        $pusher->trigger('vehicle.'.$request->vehicleId.'', 'BookedRide', $rideData);
        // Broadcast the event
        // broadcast(new DriverAssigned($rideData))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle selected successfully!'
        ]);
    }

    public function acceptRide(Request $request)
    {
        $rideRequest = RideOrder::findOrFail($request->rideId);

        // if ($rideRequest->status !== 'Vehicle Selected') {
        //     return response()->json(['success' => false, 'message' => 'This ride cannot be accepted.'], 400);
        // }

        $rideRequest->is_request_accepted = $request->is_request_accepted;
        // $rideRequest->driver_id = $request->driver_id; // Assuming driver ID is sent
        $rideRequest->save();
        $dd =  [
            'pickupLocation' => $rideRequest->originCoords,
            'dropoffLocation' => $rideRequest->destinationCoords,
            'vehId' => $rideRequest->vehicle_id,
            'status' => $rideRequest->is_request_accepted
        ];
        // dd($rideRequest);
        $options = ['cluster' => 'eu', 'useTLS' => true];
        $pusher = new Pusher('62fa54aa1df62c15f35a', '89e95c86baf51c9a03e8', '1904582', $options);

        $pusher->trigger('user.'.$rideRequest->user_id.'', 'RideAccepted', $dd);

        // Broadcast the ride acceptance to the user
        // event(new RideAccepted($rideRequest));

        return response()->json(['success' => true, 'message' => 'Ride accepted successfully!', 'rideRequest' => $rideRequest]);
    }
    public function rejectRide(Request $request)
    {
        $rideRequest = RideOrder::findOrFail($request->rideId);

        // if ($rideRequest->status !== 'Vehicle Selected') {
        //     return response()->json(['success' => false, 'message' => 'This ride cannot be accepted.'], 400);
        // }

        $rideRequest->is_request_accepted = $request->is_request_accepted;
        // $rideRequest->driver_id = $request->driver_id; // Assuming driver ID is sent
        $rideRequest->save();
        // dd($rideRequest);

        // Broadcast the ride acceptance to the user
        event(new RideAccepted($rideRequest));

        return response()->json(['success' => true, 'message' => 'Ride accepted successfully!', 'rideRequest' => $rideRequest]);
    }

    // public function broadcastDriverLocation(Request $request)
    // {
    //     // $data = $request->only(['latitude', 'longitude', 'vehID']);
    //     // $vehicle = Vehicle::find($request['vehID']);
    //     // $data['vehicle'] = $vehicle;
    //     $data = [
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //         'vehID' => $request->vehID
    //     ];
    //     // dd($data);
    //     // broadcast(new DriverLocationUpdated($data));
    //     event(new ShareDriverLocation($data));
    //     return response()->json(['success' => true, 'data' => $data]);
    // }

    public function updateLocation(Request $request)
    {
        $vehicle = Vehicle::find($request->vehID);

        if ($vehicle) {
            $vehicle->latitude = $request->latitude;
            $vehicle->longitude = $request->longitude;
            $vehicle->save();

            $data = [
                        'latitude' => $request->latitude,
                        'longitude' => $request->longitude,
                        'vehID' => $vehicle->id
                    ];

            $options = ['cluster' => 'eu', 'useTLS' => true];
            $pusher = new Pusher('62fa54aa1df62c15f35a', '89e95c86baf51c9a03e8', '1904582', $options);
            $pusher->trigger('ride.'.$vehicle->id.'', 'DriverLocation', $data);


            // Broadcast location update event
            // broadcast(new DriverLocationUpdated($vehicle->id, $request->latitude, $request->longitude));
            // event(new \App\Events\DriverStatusChanged(123, 'online'));
            return response()->json(['message' => 'Location updated successfully']);
        }

        return response()->json(['message' => 'Vehicle not found'], 404);
    }
}
