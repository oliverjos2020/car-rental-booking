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
    public $pickedVehicle;
    public $selected;
    public $vehicle;
    public $selectedVehicle;
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
        // Pre-select all required menu items (these are mandatory and shown as checked/disabled in UI)
        // Exclude vehicles (is_vehicle = 1) since vehicles are selected separately via dropdown
        $this->selectedMenus = EntertainmentMenu::where('required', 1)
            ->where('is_vehicle', '!=', 1)
            ->pluck('id')
            ->toArray();
    }
    public function updatedSelectedVehicle($value)
    {
        $this->vehicle = \App\Models\EntertainmentMenu::find($value);

        if ($this->vehicle && !in_array($this->vehicle->id, $this->selectedMenus)) {
            $this->selectedMenus[] = $this->vehicle->id;
        }
    }



    public function proceed(){
        // dd($this->selectedMenus);
        $totalAmount = 0; // Initialize total amount as an integer
        // dd($this->selectedMenus);
        foreach ($this->selectedMenus as $id) {
            // Retrieve the amount for the given ID and add it to the total
            $menuDetails = EntertainmentMenu::where('id', $id)->first();
            $amount = $menuDetails->amount ?? 0;
            $chargePerHour = $menuDetails->charge_per_hour ?? 0;

            // If charged per hour, multiply by the hours from the booking form
            if ($chargePerHour == 1) {
                $totalAmount += $amount * $this->hours;
            } else {
                $totalAmount += $amount;
            }
        }
        // dd($totalAmount);
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
                'amount' => $totalAmount,
                'entertainment' => 1,
                'stop_location' => $this->stop_location,
                'vehicle_id' => $this->vehicle->id
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
        $menus = EntertainmentMenu::where('is_vehicle', '!=', 1)->get();
        $isVehicles = EntertainmentMenu::where('is_vehicle', 1)->get();
            return view('livewire.home.entertainment-listing', compact('brands', 'categories', 'locations', 'hireTypes', 'menus', 'isVehicles'))
    ->layout('components.home.home-master-3');
    }
}