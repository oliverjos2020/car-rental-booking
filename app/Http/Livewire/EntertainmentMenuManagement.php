<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EntertainmentMenu;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Exception;

class EntertainmentMenuManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $item;
    public $required = 0;
    public $amount;
    public $editingID;
    public $editingItem;
    public $editingAmount;
    public $editingRequired;
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
            'item' => ['required', 'unique:entertainment_menus,item', 'min:2', 'max:50'],
            'amount' => ['required']
        ]);

        try{
        EntertainmentMenu::create([
            'item' => $this->item,
            'amount' => $this->amount,
            'required' => $this->required
        ]);
        $this->reset(['item', 'amount', 'required']);
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'menu Created Successfully',
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
        $this->editingItem = EntertainmentMenu::find($id)->item;
        $this->editingAmount = EntertainmentMenu::find($id)->amount;
        $this->editingRequired = EntertainmentMenu::find($id)->required;
    }

    public function cancelEdit()
    {
        $this->reset('editingID', 'editingItem', 'editingAmount', 'editingRequired');
    }

    public function update()
    {
        try {
           
            $this->validateOnly('editingcategory', ['editingItem' => 'required','editingAmount' => 'required']);
            // dd($this->editingAmount);
            EntertainmentMenu::find($this->editingID)->update([
                'item' => $this->editingItem,
                'amount' => $this->editingAmount,
                'required' => $this->editingRequired
            ]);
            $this->cancelEdit();
            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Record Updated Successfully'
            ]);
            return;
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
            EntertainmentMenu::findOrfail($id)->delete();
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
        $entertainment = EntertainmentMenu::query()->where('item', 'like', '%' . $this->search . '%')->latest()->paginate($this->limit);
        return view('livewire.entertainment-menu-management', [
            'entertainments' => $entertainment,
        ])->layout('components.dashboard.dashboard-master');
    }
}
