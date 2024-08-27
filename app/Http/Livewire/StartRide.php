<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StartRide extends Component
{
    public $latitude;
    public $longitude;
    public $vehId;


    protected $rules = [
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ];


    public function mount($vehId)
    {
        $this->vehId = $vehId;
    }

    public function updateLocation()
    {
        $this->validate();
        $driver = Auth::user(); // Assuming the driver is authenticated
        $driver->latitude = $this->latitude;
        $driver->longitude = $this->longitude;
        $driver->save();
        session()->flash('message', 'Location updated successfully!');
    }

    public function render()
    {
        return view('livewire.start-ride', [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ])->layout('components.dashboard.dashboard-master');
    }
}