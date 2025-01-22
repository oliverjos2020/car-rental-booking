<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarBrand;
use App\Models\PriceSetup;
use App\Models\Vehicle;
use App\Models\Location;
use App\Models\Category;
use App\Models\EntertainmentMenu;
use Livewire\WithPagination;
use App\Models\BookingOrder;
use Exception;

class EntertainmentListing extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selected;
    public $event;
    public $address;
    public $participants;
    public $hours;
    public $no_of_stops;
    public $stop_location;
    public $selectedMenus = [];
    public $entertainment_date;

    public function mount()
    {
        $this->selectedMenus = EntertainmentMenu::where('required', 1)->pluck('id')->toArray();
        // $this->selected = 1;
        // $this->event = "";
        // $this->address = "";
        // $this->participants = "";
        // $this->hours = "";
        // $this->no_of_stops = "";
    }

    public function proceed(){
        // dd($this->selectedMenus);
        $amount = 0; // Initialize $ammount as an integer

        foreach ($this->selectedMenus as $id) {
            // Retrieve the amount for the given ID and add it to the total
            $menuAmount = EntertainmentMenu::where('id', $id)->value('amount');
            $amount += $menuAmount;
        }
        // dd($amount);
        // try{
            $this->validate([
                'event' => ['required'],
                'address' => ['required'],
                'participants' => ['required'],
                'hours' => ['required'],
                'no_of_stops' => ['required'],
                'selectedMenus' => ['array','required'],
                'entertainment_date' => ['required'],
                'stop_location' => ['required']
            ]);

            $data = [
                'event' => $this->event,
                'address' => $this->address,
                'participants' => $this->participants,
                'hours' => $this->hours,
                'no_of_stops' => $this->no_of_stops,
                'selectedMenus' => json_encode($this->selectedMenus),
                'entertainment_date' => $this->entertainment_date,
                'user_id' => auth()->user()->id,
                'payment_status' => 0,
                'status' => 0,
                'amount' => $amount * $this->hours,
                'entertainment' => 1,
                'stop_location' => $this->stop_location
            ];
            // dd($data);
            BookingOrder::create($data);
            return redirect()->route('entertainmentCheckout');
        // }catch(Exception $e){
        //     $this->dispatchBrowserEvent('notify', [
        //                 'type' => 'error',
        //                 'message' => $e->getMessage(),
        //             ]);
        //             return;
        // }
    }

    public function render()
    {


        $brands = CarBrand::all();
        $categories = PriceSetup::all();
        $locations = Location::all();
        $hireTypes = Category::all();
        $menus = EntertainmentMenu::all();
            return view('livewire.home.entertainment-listing', compact('brands', 'categories', 'locations', 'hireTypes', 'menus'))
    ->layout('components.home.home-master-3');
    }
}

