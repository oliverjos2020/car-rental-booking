<?php

namespace App\Http\Livewire;

use App\Models\Voucher;
use Livewire\Component;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VoucherManagement extends Component
{

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $voucher_name;
    public $voucher_code;
    public $discount_amount;
    public $discount_type;
    public $valid_from;
    public $valid_until;
    public $editing_voucher_name;
    public $editing_voucher_code;
    public $editing_discount_amount;
    public $editing_discount_type;
    public $editing_valid_from;
    public $editing_valid_until;
    public $editingID;
    public $limit = '10';

    protected $queryString = ['limit', 'search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->validate([
            'voucher_name' => ['required', 'unique:vouchers,voucher_name', 'min:2', 'max:50'],
            'discount_amount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'valid_from' => ['required', 'date'],
            'valid_until' => ['required', 'date', 'after:valid_from'],
        ]);
        try{
        Voucher::create([
            'voucher_name' => $this->voucher_name,
            'voucher_code' => strtoupper(Str::random(10)),
            'discount_amount' => $this->discount_amount,
            'discount_type' => $this->discount_type,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
        ]);
        $this->reset(['voucher_name', 'discount_amount', 'discount_type', 'valid_from', 'valid_until']);
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Voucher Created Successfully',
        ]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
            return;
        }
    }

    public function edit($id)
    {
        $data = Voucher::find($id);
        $this->editingID = $id;
        $this->editing_voucher_name = $data->voucher_name;
        $this->editing_discount_amount = $data->discount_amount;
        $this->editing_discount_type = $data->discount_type;
        $this->editing_valid_from = $data->valid_from;
        $this->editing_valid_until = $data->valid_until;
    }

    public function cancelEdit()
    {
        $this->reset('editingID', 'editing_voucher_name', 'editing_discount_amount', 'editing_discount_type', 'editing_valid_from', 'editing_valid_until');
    }

    public function update()
    {
        try {
            $this->validate([
                'editing_voucher_name' => 'required',
                'editing_discount_amount' => 'required|numeric|min:0',
                'editing_discount_type' => 'required|in:percentage,fixed',
                'editing_valid_from' => 'required|date',
                'editing_valid_until' => 'required|date|after:editing_valid_from'
            ]);
            Voucher::find($this->editingID)->update([
                'voucher_name' => $this->editing_voucher_name,
                'discount_amount' => $this->editing_discount_amount,
                'discount_type' => $this->editing_discount_type,
                'valid_from' => $this->editing_valid_from,
                'valid_until' => $this->editing_valid_until,
            ]);
            $this->cancelEdit();
        }catch(Exception $e){
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
            return;

        }
    }

    public function delete($id)
    {
        try{
            Voucher::findOrfail($id)->delete();
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Deleted Successfully',
            ]);
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
        $vouchers = Voucher::query()->where('voucher_name', 'like', '%' . $this->search . '%')->latest()->paginate($this->limit);
        return view('livewire.voucher-management', [
            'vouchers' => $vouchers,
        ])->layout('components.dashboard.dashboard-master');
    }
}
