<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserManagement extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $name;
    public $email;
    public $password;
    public $editingID;
    public $editingName;
    public $editingEmail;
    public $editingPassword;
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
    

    public function createUser(Request $request)
    {
        $validateData = $this->validate([
            
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required']
        ]);
        // dd($validateData['name']);
        try{
        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password'])
        ]);
        // User::create($validateData);
        $this->reset(['name', 'email', 'password']);
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => 'User Created Successfully',
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
        $this->editingName = User::find($id)->name;
        $this->editingEmail = User::find($id)->email;
        // $this->editingamount = User::find($id)->amount;
    }

    public function cancelEdit()
    {
        $this->reset('editingID', 'editingName', 'editingEmail', 'editingPassword');
    }

    public function update()
    {
        // try {
            // $this->validateOnly('editingitem', ['editingitem' => 'required', 'editingduration' => 'required', 'editingamount' => 'required']);
            $this->validate([
                'editingName' => ['required'],
                'editingEmail' => ['required'],
                // 'editingPassword' => ['required'],
            ]);

            User::find($this->editingID)->update([
                'name' => $this->editingName,
                'email' => $this->editingEmail,
                // 'password' => $this->editingPassword
            ]);
            $this->cancelEdit();
        // }catch(Exception $e){
        //     $this->dispatchBrowserEvent('notify', [
        //         'type' => 'error',
        //         'message' => $e->getMessage(),
        //     ]);
        //     return;

        // }
    }

    public function delete($id)
    {
        try{
            User::findOrfail($id)->delete();
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
        $userManagement = User::where('name', 'like', '%' . $this->search . '%')->latest()->paginate($this->limit);
        return view('livewire.user-management', [
            'users' => $userManagement,
        ])->layout('components.dashboard.dashboard-master');
    }
}
