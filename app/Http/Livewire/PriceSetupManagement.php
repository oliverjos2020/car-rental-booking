<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PriceSetup;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Exception;

class PriceSetupManagement extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $item;
    public $duration;
    public $amount;
    public $editingID;
    public $editingitem;
    public $editingduration;
    public $editingamount;
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
    

    public function createPriceSetup()
    {
        $validateData = $this->validate([
            // 'brand' => ['required', 'unique:car_brands,brand', 'min:2', 'max:50']
            'item' => ['required', 'min:2', 'max:50'],
            'duration' => ['required', 'max:50'],
            'amount' => ['required', 'max:50']
        ]);
        try{
        PriceSetup::create($validateData);
        $this->reset(['item', 'duration', 'amount']);
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'Item Setup Successfully',
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
        $this->editingID = $id;
        $this->editingitem = PriceSetup::find($id)->item;
        $this->editingduration = PriceSetup::find($id)->duration;
        $this->editingamount = PriceSetup::find($id)->amount;
    }

    public function cancelEdit()
    {
        $this->reset('editingID', 'editingitem', 'editingduration', 'editingamount');
    }

    public function update()
    {
        try {
            // $this->validateOnly('editingitem', ['editingitem' => 'required', 'editingduration' => 'required', 'editingamount' => 'required']);
            $this->validate([
                'editingitem' => ['required', 'min:2', 'max:50'],
                'editingduration' => ['required', 'min:2', 'max:50'],
                'editingamount' => ['required', 'min:2', 'max:50'],
            ]);

            PriceSetup::find($this->editingID)->update([
                'item' => $this->editingitem,
                'duration' => $this->editingduration,
                'amount' => $this->editingamount,
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
            PriceSetup::findOrfail($id)->delete();
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
        $priceSetups = PriceSetup::query()->where('item', 'like', '%' . $this->search . '%')->latest()->paginate($this->limit);
        return view('livewire.price-setup-management', [
            'priceSetups' => $priceSetups,
        ])->layout('components.dashboard.dashboard-master');

        // return view('livewire.price-setup-management');
    }
}