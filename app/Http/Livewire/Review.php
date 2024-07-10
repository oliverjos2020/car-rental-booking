<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class Review extends Component
{
    public $reviewId;
    public function mount($reviewId)
    {
        $this->reviewId = $reviewId;
    }
    
    // dd($reviewId);
    public function render()
    {
        // dd($this->reviewId);
        $vehicle = Vehicle::where('id', $this->reviewId)->first();
        return view('livewire.home.review', ['vehicle' => $vehicle]) ->layout('components.home.home-master-3');

    }
}
