<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DecideTrip extends Component
{
    public function render()
    {
        return view('livewire.home.trip-decide')->layout('components.home.home-master-3');
    }
}
