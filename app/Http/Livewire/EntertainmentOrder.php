<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookingOrder;
use Livewire\WithPagination;

class EntertainmentOrder extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $status;
    public $limit = '10';
    protected $queryString = ['limit', 'search'];
    public function render()
    {
        $orders = BookingOrder::where('status', 1)->where('entertainment', 1)->latest()->paginate($this->limit);
        return view('livewire.entertainment-order', [
            'orders' => $orders,
        ])->layout('components.dashboard.dashboard-master');
    }
}
