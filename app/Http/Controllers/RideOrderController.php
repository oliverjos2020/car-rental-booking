<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RideOrder;
use App\Models\Vehicle;

class RideOrderController extends Controller
{
    public function orderRide(Request $request)
    {
        // dd($request);
        $request->validate([
            'vehicle_id' => 'required',
            'user_id' => 'required',
            'originCoords' => 'required',
            'destinationCoords' => 'required',
            'charge' => 'required',
        ]);
        $id = Auth()->user()->id;
        $checkActiveTrips = RideOrder::where('user_id', $id)->where('status', 0)->get();
        if ($checkActiveTrips->isEmpty()):
            $order = Vehicle::where('id', $request->vehicle_id)->first();
            $orderCreate = RideOrder::create([
                'vehicle_id' => $request->vehicle_id,
                'user_id' => $request->user_id,
                'originCoords' => json_encode($request->originCoords, true),
                'destinationCoords' => json_encode($request->destinationCoords, true),
                'amount' => $request->charge,
                'driver_id' => $order->user_id
            ]);
            return response()->json(['message' => 'Order successful', 'responseCode' => 200, 'data' => $orderCreate]);
        else:
            return response()->json(['message' => 'You have active trips. End them to start another one', 'responseCode' =>204]);
        endif;
    }

    public function cancelRide(Request $request)
    {
        $id = Auth()->user()->id;
        $cancel = RideOrder::where('user_id', $id)->where('vehicle_id', $request->vehicle_id)->update(['status' => 3]);
        if($cancel){
            return response()->json(['message' => 'Ride cancelled successfully', 'responseCode' => 200]);
        }else{
            return response()->json(['message' => 'Oops could not cancel ride', 'responseCode' => 204]);
        }
    }

    public function fetchRide()
    {
        $id = Auth()->user()->id;
        $vehicleIds = RideOrder::where('user_id', $id)
        ->where('status', 0)
        ->pluck('vehicle_id')
        ->toArray();
        return response()->json($vehicleIds);
    }

    public function driverOrders()
    {
        $id = Auth()->user()->id;
        $myVehicles = Vehicle::where('user_id', Auth()->user()->id)->where('status', 2)->pluck('id')->toArray();
        $activeOrders = RideOrder::whereIn('vehicle_id', $myVehicles)->where('status', 0)->get();
        $drivers = \DB::table('ride_orders')->join('users', 'ride_orders.user_id', '=', 'users.id')->selectRaw("ride_orders.id, users.name, ride_orders.originCoords, ride_orders.destinationCoords, ride_orders.amount, ride_orders.vehicle_id, ride_orders.status")->where('ride_orders.status', 0)->orWhere('ride_orders.status', 1)->get();
        return response()->json($drivers);
    }

    public function acceptRequest(Request $request)
    {
        $order = RideOrder::where('id', $request->id)->first();
        return response()->json(['message' => 'successful', 'responseCode' => 200, 'data' => $order]);
    }

    public function acceptRide(Request $request)
    {
        $id = Auth()->user()->id;
        $checkActiveTrips = RideOrder::where('user_id', $id)->where('status', 0)->get();
        Vehicle::where('id', $request->vehicleId)->update(['on_trip' => 1]);
        if ($checkActiveTrips->isEmpty()):
            RideOrder::where('id', $request->id)->update(['is_request_accepted' => 1, 'status' => 1]);
            return response()->json(['message' => 'Trip accepted successfully', 'responseCode' => 200]);
        else:
            return response()->json(['message' => 'Kindly end all active trips to accept a trip', 'responseCode' => 204]);
        endif;
    }

    public function rejectRide(Request $request)
    {
        RideOrder::where('id', $request->id)->update(['is_request_accepted' => 2, 'status' => 3]);
        $order = RideOrder::where('id', $request->id)->first();
        Vehicle::where('id', $order->vehicle_id)->update(['on_trip' => 0]);
        return response()->json(['message' => 'Trip rejected successfully', 'responseCode' => 200]);
    }
}
