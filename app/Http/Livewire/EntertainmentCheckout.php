<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookingOrder;

class EntertainmentCheckout extends Component
{

    public function deleteOrder($id)
    {
        try{
            BookingOrder::findOrfail($id)->delete();

            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Order deleted successfully',
            ]);
            // $this->resetPage();

        } catch (Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
            return;
        }

    }
    public function render()
    {

        $user = Auth()->user()->id;
        $totalAmount = BookingOrder::where('user_id', $user)->where('payment_status', 0)->where('entertainment', 1)  // Ensure 'selectedMenus' is not null
        ->where('selectedMenus', '!=', '') ->sum('amount');
        $order = BookingOrder::where('user_id', $user)->where('payment_status', 0)->where('entertainment', 1)  // Ensure 'selectedMenus' is not null
        ->where('selectedMenus', '!=', '') ->get();
        return view('livewire.home.entertainment-checkout', ['orders' => $order, 'totalAmount' => $totalAmount])->layout('components.home.home-master-4');

    }
}
