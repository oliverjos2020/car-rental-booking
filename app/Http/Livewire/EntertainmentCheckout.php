<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookingOrder;
use App\Models\Voucher;
use Carbon\Carbon;

class EntertainmentCheckout extends Component
{
    public $voucherCode = '';
    public $appliedVoucher = null;
    public $voucherDiscount = 0;
    public $voucherError = '';
    public $showVoucherNotification = false;

    public function applyVoucher()
    {
        $this->voucherError = '';
        $this->appliedVoucher = null;
        $this->voucherDiscount = 0;

        // Validate voucher code is not empty
        if (empty($this->voucherCode)) {
            $this->voucherError = 'Please enter a voucher code';
            return;
        }

        // Find the voucher
        $voucher = Voucher::where('voucher_code', $this->voucherCode)->first();

        if (!$voucher) {
            $this->voucherError = 'Invalid voucher code';
            return;
        }

        // Check if voucher is valid (date range)
        $now = Carbon::now();
        $validFrom = Carbon::parse($voucher->valid_from);
        $validUntil = Carbon::parse($voucher->valid_until);

        if ($now->lt($validFrom)) {
            $this->voucherError = 'This voucher is not yet valid';
            return;
        }

        if ($now->gt($validUntil)) {
            $this->voucherError = 'This voucher has expired';
            return;
        }

        // Calculate total amount
        $user = Auth()->user()->id;
        $totalAmount = BookingOrder::where('user_id', $user)
            ->where('payment_status', 0)
            ->where('entertainment', 1)
            ->where('selectedMenus', '!=', '')
            ->sum('amount');

        // Check if total is greater than 200
        if ($totalAmount <= 200) {
            $this->voucherError = 'Voucher can only be applied to orders over 200';
            return;
        }

        // Apply discount
        $this->appliedVoucher = $voucher;
        
        if ($voucher->discount_type === 'percentage') {
            $this->voucherDiscount = ($totalAmount * $voucher->discount_amount) / 100;
        } else {
            $this->voucherDiscount = $voucher->discount_amount;
        }

        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Voucher applied successfully! You saved ' . number_format($this->voucherDiscount, 2),
        ]);
    }

    public function removeVoucher()
    {
        $this->voucherCode = '';
        $this->appliedVoucher = null;
        $this->voucherDiscount = 0;
        $this->voucherError = '';

        $this->dispatchBrowserEvent('notify', [
            'type' => 'info',
            'message' => 'Voucher removed',
        ]);
    }

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
        
        // Check if total is greater than 200 and get a valid voucher
        $eligibleVoucher = null;
        if ($totalAmount > 200) {
            $eligibleVoucher = Voucher::where('valid_from', '<=', Carbon::now())
                ->where('valid_until', '>=', Carbon::now())
                ->first();
        }
        
        // Calculate final amount after discount
        $finalAmount = $totalAmount - $this->voucherDiscount;
        
        return view('livewire.home.entertainment-checkout', [
            'orders' => $order, 
            'totalAmounts' => $totalAmount,
            'eligibleVoucher' => $eligibleVoucher,
            'finalAmount' => $finalAmount
        ])->layout('components.home.home-master-4');

    }
}
