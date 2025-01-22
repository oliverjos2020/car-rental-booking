<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\BookingOrder;
use Illuminate\Support\Facades\DB;


class Dashboard extends Component
{
    public function render()
    {

            $currentYear = Carbon::now()->year;
            $data = DB::table('users')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                ->whereIn('role_id', [2, 3, 4])
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('count', 'month')->toArray();

            // Ensure all months are represented
            $usersChart = array_fill(1, 12, 0); // Fill with 0 for all 12 months
            foreach ($data as $month => $count) {
                $usersChart[$month] = $count;
            }

            $data1 = DB::table('vehicles')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                ->where('status', 2)
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('count', 'month')->toArray();

            // Ensure all months are represented
            $approvedVehicleChart = array_fill(1, 12, 0); // Fill with 0 for all 12 months
            foreach ($data1 as $month1 => $count1) {
                $approvedVehicleChart[$month1] = $count1;
            }

            $data2 = DB::table('vehicles')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                ->where('status', 2)
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('count', 'month')->toArray();

            // Ensure all months are represented
            $pendingVehicleChart = array_fill(1, 12, 0); // Fill with 0 for all 12 months
            foreach ($data2 as $month2 => $count2) {
                $pendingVehicleChart[$month2] = $count2;
            }


        $user = User::whereIn('role_id', [2, 3, 4])->get();
        $approved = Vehicle::where('status', 2)->get();
        $pending = Vehicle::where('status', 1)->get();
        $myVehicles = Vehicle::where('user_id', auth()->user()->id)->where('status', 2)->pluck('id')->toArray();
        // dd($myVehicles);
        $pendingRequest = Vehicle::where('user_id', Auth()->user()->id)->where('status', 2)->where('on_trip', 1)->get();
        $approvedRequest = BookingOrder::whereIn('vehicle_id', $myVehicles)->where('status', 2)->get();
        $completedTrips = BookingOrder::where('status', 3)->get();
        $partnerVehicles = Vehicle::where('user_id', Auth()->user()->id)->where('status', 2)->get();
        $partnerVehiclesArray = Vehicle::where('user_id', Auth()->user()->id)->where('status', 2)->pluck('id')->toArray();
        $activeOrders = BookingOrder::whereIn('vehicle_id', $partnerVehiclesArray)->where('status', 1)->get();
        // dd($activeOrders);
        // $pendingArtisans = Vehicle::where('role_id', 2)->where('status', 0)->where('role_id', 2)->get();
        return view('dashboard.dashboard2', ['users' => $user, 'approved' => $approved, 'pending' => $pending, 'pendingRequest' => $pendingRequest, 'approvedRequest' => $approvedRequest, 'partnerVehicles' => $partnerVehicles, 'orders' => $activeOrders, 'completedTrips' => $completedTrips, 'usersChart' => $usersChart, 'approvedVehicleChart' => $approvedVehicleChart, 'pendingVehicleChart' => $pendingVehicleChart])->layout('components.dashboard.dashboard-master');
    }
}
