<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Exception;

class RideResults extends Component
{
    public $location;
    public $destination;
    public $distance;
    public $distanceText;
    public $latitude;
    public $longitude;
    public $nearestDrivers = [];
    public $suggestionsLocation = [];
    public $suggestionsDestination = [];
    public $charge;
    public $durationText;

    public function mount()
    {
        $this->location = request('location');
        $this->destination = request('destination');
        // $this->calculateDistance();
        // $this->findDrivers();
    }

    // public function updated($field)
    // {
    //     if ($field === 'location') {
    //         $this->suggestionsLocation = $this->getSuggestions($this->$field);
    //     } elseif ($field === 'destination') {
    //         $this->suggestionsDestination = $this->getSuggestions($this->$field);
    //     }
    // }
    public function updatedLocation()
    {
        $this->suggestionsLocation = $this->getSuggestions($this->location);
    }

    public function updatedDestination()
    {
        $this->suggestionsDestination = $this->getSuggestions($this->destination);
    }

    private function getSuggestions($input)
    {
        try{
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
    public function selectSuggestion($field, $placeId, $description)
    {
        if ($field === 'location') {
            $this->location = $description;
            $this->suggestionsLocation = [];
        } elseif ($field === 'destination') {
            $this->destination = $description;
            $this->suggestionsDestination = [];
        }
        $this->emit('locationSelected', $placeId);
    }
    


    // public function selectSuggestion($field, $suggestion)
    // {
    //     $this->$field = $suggestion;
    //     if ($field === 'location') { 
    //         $this->suggestionsLocation = [];
    //     } elseif ($field === 'destination') {
    //         $this->suggestionsDestination = [];
    //     }
    // }

    // private function calculateDistance()
    // {
    //     try {
    //         $userCoordinates = $this->getCoordinates($this->location);
    //         $destinationCoordinates = $this->getCoordinates($this->destination);

    //         if (!$userCoordinates || !$destinationCoordinates) {
    //             Session::flash('error', 'Unable to get coordinates for the given addresses.');
    //             return;
    //         }

    //         $this->latitude = $userCoordinates['lat'];
    //         $this->longitude = $userCoordinates['lng'];

    //         $apiKey = env('GOOGLE_API_KEY');
    //         $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
    //             'origins' => "{$this->latitude},{$this->longitude}",
    //             'destinations' => "{$destinationCoordinates['lat']},{$destinationCoordinates['lng']}",
    //             'key' => $apiKey,
    //         ]);

    //         // $distanceText = $response->json()['rows'][0]['elements'][0]['distance']['text'];
    //         // $this->distanceText = $distanceText;
    //         // $this->distance = $this->extractNumericDistance($distanceText);

    //         $elements = $response->json()['rows'][0]['elements'][0];
    //         $this->distanceText = $elements['distance']['text'];
    //         $this->durationText = $elements['duration']['text']; // Estimated time
    //         $this->distance = $this->extractNumericDistance($this->distanceText);
    //     } catch (Exception $e) {
    //         Session::flash('error', 'Could not resolve host issues with maps.googleapis.com. kindly check your internet');
    //     }
    // }

    // private function findDrivers()
    // {
    //     if ($this->latitude && $this->longitude) {
    //         $this->nearestDrivers = $this->findNearestDrivers($this->latitude, $this->longitude);
    //     }
    // }

    // private function getCoordinates($address)
    // {
    //     $apiKey = env('GOOGLE_API_KEY');
    //     $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
    //         'address' => $address,
    //         'key' => $apiKey,
    //     ]);

    //     if ($response->successful()) {
    //         $location = $response->json()['results'][0]['geometry']['location'];
    //         return [
    //             'lat' => $location['lat'],
    //             'lng' => $location['lng'],
    //         ];
    //     }

    //     return null;
    // }

    // private function extractNumericDistance($distanceText)
    // {
    //     if (preg_match('/[\d.]+/', $distanceText, $matches)) {
    //         return (float) $matches[0];
    //     }

    //     return 0;
    // }

    // private function findNearestDrivers($latitude, $longitude, $radius = 50)
    // {
    //     $drivers = \DB::table('users')
    //         ->selectRaw("id, name, latitude, longitude, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$latitude, $longitude, $latitude])
    //         ->having('distance', '<', $radius)
    //         ->orderBy('distance')
    //         ->get();

    //     return $drivers;
    // }

    public function render()
    {
        // $ratePerMile = 1.5; // Example rate per mile
        // $this->charge = $this->distance * $ratePerMile;

        return view('livewire.ride-results', [
            // 'location' => $this->location,
            // 'destination' => $this->destination,
            // 'distance' => $this->distance,
            // 'charge' => $charge,
            // 'nearestDrivers' => $this->nearestDrivers,
            // 'durationText' => $this->durationText, 
        ])->layout('components.home.home-master-ride');
    }
}
