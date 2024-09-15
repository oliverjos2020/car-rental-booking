<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookingOrder;

use Livewire\WithPagination;

class MyBookingOrders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $limit = '10';
    protected $queryString = ['limit'];
    public $type;
    public function mount($type){
        $this->type = $type;
    }

    public function render()
    {
        if($this->type == 'entertainment'){
            $this->type = 1;
        }elseif($this->type == 'booking'){
            $this->type = 0;
        }
        $id = Auth()->user()->id;
        $myOrders = BookingOrder::where('user_id', $id)->where('payment_status', 1)->where('entertainment', $this->type)->latest()->paginate($this->limit);
        // dd($myOrders);
        return view('livewire.home.my-booking-orders', ['myOrders' => $myOrders])->layout('components.home.home-master-3');
    }
}
