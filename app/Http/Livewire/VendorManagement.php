<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Vehicle;
use Livewire\WithPagination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class VendorManagement extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $status;
    // public $email;
    // public $password;
    // public $editingID;
    // public $editingName;
    // public $editingEmail;
    // public $editingPassword;
    public $limit = '10';
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    protected $queryString = ['limit', 'search'];

     public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }
    

    public function render()
    {
            if ($this->type == 'pending'):
                $status = 1;
            elseif ($this->type == 'declined'):
                $status = 3;
            elseif ($this->type == 'approved'):
                $status = 2;
            endif;

            $vehicleManagement = Vehicle::query()->where('vehicleMake', 'like', '%' . $this->search . '%')->where('status', $status)->latest()->paginate($this->limit);
        // dd($vehicleManagement);
            return view('livewire.vendor-management', [
                'vehicles' => $vehicleManagement,
            ])->layout('components.dashboard.dashboard-master');

    }
}
