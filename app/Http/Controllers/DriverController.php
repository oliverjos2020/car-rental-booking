<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;

class DriverController extends Controller
{
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'vehID' => 'required|numeric'
        ]);

        Vehicle::where('id', $request->vehID)->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        // $driver = Auth::user();
        // $driver->latitude = $request->latitude;
        // $driver->longitude = $request->longitude;
        // $driver->save();

        return response()->json(['message' => 'Location updated successfully']);
    }

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
    ->having('distance', '<', $radius)
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
}
