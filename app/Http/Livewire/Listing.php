<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarBrand;
use App\Models\PriceSetup;
use App\Models\Vehicle;
use App\Models\Location;
use Livewire\WithPagination;


class Listing extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $limit = '9';
    public $selected;
    public $make;
    public $transmission;
    public $category;
    public $location;

    protected $queryString = ['limit', 'search', 'make', 'transmission', 'location', 'category'];
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }
    public function resetButton()
    {
        $this->make = null;
        $this->transmission = null;
        $this->category = null;
        $this->location = null;
        $this->resetPage();

    }

    public function submit(){

    }

    public function render()
    { 

    $vehicles = Vehicle::with(['photos', 'priceSetup'])
        ->when($this->make, function ($query) {
            return $query->where('vehicleMake', $this->make);
        })->when($this->transmission, function ($query) {
                return $query->where('transmission', $this->transmission);
            })->when($this->location, function ($query) {
                return $query->where('location', $this->location);
            })->when($this->category, function ($query) {
                return $query->whereHas('priceSetup', function ($query) {
                    $query->where('id', $this->category);
                });
            })
        ->where('vehicleMake', 'like', '%' . $this->search . '%')->where('status', 2)
        ->latest()
        ->paginate($this->limit);
        $brands = CarBrand::all();
        $categories = PriceSetup::all();
        $locations = Location::all();
            return view('livewire.home.listing2', compact('brands', 'categories', 'vehicles', 'locations'))
    ->layout('components.home.home-master-3');


    }
}
