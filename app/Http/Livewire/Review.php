<?php

namespace App\Http\Livewire;

use App\Models\BookingOrder;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\PayPalService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Review extends Component
{
    use WithFileUploads;
    public $reviewId;
    public $pickupDate;
    public $pickupTime;
    public $dropoffDate;
    public $dropoffTime;
    public $days = 0;
    public $insurance;
    public $driversLicense;
    public $existingInsurance;
    public $existingdriversLicense;
    public $step = 1;
    public $amount = 200;

    protected $listeners = ['onApprove'];

    public function createOrder(PayPalService $paypal)
    {
        try {
            // Validate the amount
            if (!is_numeric($this->amount) || $this->amount <= 0) {
                throw new Exception('Invalid amount');
            }

            $payment = $paypal->createOrder($this->amount);
            return response()->json(['id' => $payment->getId()]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function onApprove($details)
    {
        session()->flash('success', 'Payment successful!');
    }

    public function calculate()
    {
        $pickupDate = Carbon::parse($this->pickupDate);
        $dropoffDate = Carbon::parse($this->dropoffDate);

        $this->days = $pickupDate->diffInDays($dropoffDate);
    }

    public function updatedDropoffDate()
    {
        $this->calculate();
    }
    public function mount($reviewId)
    {
        $this->reviewId = $reviewId;
        $this->existingdriversLicense = Auth()->User()->driverLicense ?? null;
        $this->existingInsurance = Auth()->User()->insurance ?? null;
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->step++;
    }

    public function proceed()
    {
        // try {
        $rules = [
            'pickupDate' => 'required',
            'pickupTime' => 'required',
            'dropoffDate' => 'required',
            'dropoffTime' => 'required',
            // 'driversLicense' => 'required|image|max:300',
            // 'insurance' => 'required|image|max:300',
        ];

        $vehicle = Vehicle::where('id', $this->reviewId)->first();
        $amount = $vehicle->priceSetup->amount * $this->days;

        // $driverLicense = Auth()->User()->driversLicense;
        // $insurance = Auth()->User()->insurance;
        $driverLicensePath = "";
        $insurancePath = "";
        if (empty($this->existingdriversLicense) || empty($this->existingInsurance)):
            $rules['driversLicense'] = 'required|image|max:300';
            $rules['insurance'] = 'required|image|max:300';

            if ($this->driversLicense):
                $filenameI = 'driversLicense-' . Str::random(10) . '.' . $this->driversLicense->extension();
                $pathI = $this->driversLicense->storeAs('uploads/driversLicense', $filenameI, 'public');
                $driverLicensePath = Storage::url($pathI);
            endif;
            if ($this->insurance):
                $filenameII = 'insurance-' . Str::random(10) . '.' . $this->insurance->extension();
                $pathII = $this->insurance->storeAs('uploads/insurance', $filenameII, 'public');
                $insurancePath = Storage::url($pathII);
            endif;
        else:
            if ($this->driversLicense):
                $filenameI = 'driversLicense-' . Str::random(10) . '.' . $this->driversLicense->extension();
                $pathI = $this->driversLicense->storeAs('uploads/driversLicense', $filenameI, 'public');
                $driverLicensePath = Storage::url($pathI);
            endif;
            if ($this->insurance):
                $filenameII = 'insurance-' . Str::random(10) . '.' . $this->insurance->extension();
                $pathII = $this->insurance->storeAs('uploads/insurance', $filenameII, 'public');
                $insurancePath = Storage::url($pathII);
            endif;
        endif;

        $this->validate($rules);
        // dd($driverLicensePath);
        if (empty($this->existingdriversLicense) || empty($this->existingInsurance)):
            User::find(Auth()->User()->id)->update([
                'driverLicense' => $driverLicensePath,
                'insurance' => $insurancePath,
            ]);
        endif;
        // Vehicle::find($this->reviewId)->update(['on_trip', 1]);
        $booking = BookingOrder::create([
            'user_id' => Auth()->User()->id,
            'vehicle_id' => $this->reviewId,
            'pickupDate' => $this->pickupDate,
            'pickupTime' => $this->pickupTime,
            'dropoffDate' => $this->dropoffDate,
            'dropoffTime' => $this->dropoffTime,
            'duration' => $this->days,
            'amount' => $amount,
            'payment_status' => 1,
            'status' => 1,

        ]);
        if ($booking):
            $this->step++;
        endif;
        // } catch (Exception $e) {
        //     $this->dispatchBrowserEvent('notify', [
        //         'type' => 'error',
        //         'message' => $e->getMessage(),
        //     ]);
        //     return;
        // }
    }
    public function previousStep()
    {
        $this->step--;
    }

    protected function validateCurrentStep()
    {
        $rules = [];
        if ($this->step == 1) {
            $rules = [
                'pickupDate' => 'required',
                'pickupTime' => 'required',
                'dropoffDate' => 'required',
                'dropoffTime' => 'required',
                'driversLicense' => 'required|image|max:300',
                'insurance' => 'required|image|max:300',
            ];
        }
        // $this->validate($rules);
    }
    
    public function getClientToken(PayPalService $paypal)
{
    try {
        $clientToken = $paypal->generateClientToken();
        return response()->json(['client_token' => $clientToken]);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function render()
    {
        // dd($this->pickupDate);
        $vehicle = Vehicle::where('id', $this->reviewId)->first();
        return view('livewire.home.review', ['vehicle' => $vehicle, 'days' => $this->days])->layout('components.home.home-master-3');

    }
}
