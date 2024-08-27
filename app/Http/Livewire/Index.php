<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PriceSetup;
use App\Models\Location;
use App\Models\CarBrand;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Session;


class Index extends Component
{

    public $category;
    public $brand;
    public $transmission;
    public $location;
    public $destination;
    public $suggestionsLocation = [];
    public $suggestionsDestination = [];

    public function updated($field)
    {
        if ($field === 'location') {
            $this->suggestionsLocation = $this->getSuggestions($this->$field);
        } elseif ($field === 'destination') {
            $this->suggestionsDestination = $this->getSuggestions($this->$field);
        }
    }

    private function getSuggestions($input)
    {
        try{
        // Call to Google Places API to get suggestions
        // Note: Replace 'YOUR_GOOGLE_API_KEY' with your actual API key.
        $apiKey = env('GOOGLE_API_KEY');
        $response = Http::get("https://maps.googleapis.com/maps/api/place/autocomplete/json", [
            'input' => $input,
            'key' => $apiKey,
        ]);

        return $response->json()['predictions'] ?? [];
     } catch (Exception $e) {
        
        // Session::flash('error', $e->getMessage());
        $response= "";
        Session::flash('error', 'Could not resolve host issues with maps.googleapis.com. kindly check your internet');
        return $response = [];
        }
    }

    public function selectSuggestion($field, $suggestion)
    {
        $this->$field = $suggestion;
        if ($field === 'location') { 
            $this->suggestionsLocation = [];
        } elseif ($field === 'destination') {
            $this->suggestionsDestination = [];
        }
    }

    public function redirectToResults()
    {
        $this->validate([
            'location' => ['required'],
            'destination' => ['required']
            // 'editingPassword' => ['required'],
        ]);
        return redirect()->route('ride.results', [
            'location' => $this->location,
            'destination' => $this->destination,
        ]);
    }
     public function submitRequest()
    {
        $this->validate([
            'category' => 'required|integer',
            'brand' => 'required|string',
            'transmission' => 'required'
        ]);

        return redirect()->route('listing', [
            'category' => $this->category,
            'make' => $this->brand,
            'transmission' => $this->transmission
        ]);
    }
    public function render()
    {
        // return view('livewire.index');
        return view('livewire.home.index2', ['categories' => PriceSetup::all(), 'locations' => Location::all(), 'brands' => CarBrand::all()])->layout('components.home.home-master-2');

    }
}
