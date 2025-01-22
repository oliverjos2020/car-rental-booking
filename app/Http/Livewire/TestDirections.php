<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestDirections extends Component
{

    public $location;
    public $destination;

    public function render()
    {
        return view('livewire.test-directions')->layout('components.home.home-master-ride');
    }
}
