<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Vehicle;


class Dashboard extends Component
{
    public function render()
    {
        $user = User::whereIn('role_id', [2, 3, 4])->get();
        $approved = Vehicle::where('status', 2)->get();
        $pending = Vehicle::where('status', 1)->get();
        return view('dashboard.dashboard2', ['users' => $user, 'approved' => $approved, 'pending' => $pending])->layout('components.dashboard.dashboard-master');;
    }
}
