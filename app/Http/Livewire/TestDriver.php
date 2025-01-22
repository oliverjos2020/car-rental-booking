<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestDriver extends Component
{
    public function render()
    {
        return view('livewire.test-driver')->layout('components.home.home-master-ride');
    }
}
