<?php

namespace App\Http\Livewire;

use App\Models\BookingOrder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\EntertainmentMenu;
use Carbon\Carbon;
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
    public $hours = 0;
    public $insurance;
    public $driversLicense;
    public $existingInsurance;
    public $existingdriversLicense;
    public $step = 1;
    public $catId;
    public $selectedMenus = [];


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
    public function calculateTime()
    {
        $pickupTime = Carbon::createFromTimeString($this->pickupTime);
        $dropoffTime = Carbon::createFromTimeString($this->dropoffTime);

        // Check if drop-off time is on the next day
        if ($dropoffTime->lt($pickupTime)) {
            $dropoffTime->addDay();
        }

        // Calculate the difference in hours
        $this->hours = $pickupTime->diffInHours($dropoffTime);
        $this->hoursAndMinutes = $pickupTime->diff($dropoffTime)->format('%h hours and %i minutes');
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
        $this->selectedMenus = EntertainmentMenu::where('required', 1)->pluck('id')->toArray();
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->step++;
    }

    public function proceed()
    {

        $vehicle = Vehicle::where('id', $this->reviewId)->first();
        // dd($this->selectedMenus);

        // if ($vehicle->category_id == 3):
        //     $rules = [
        //         'pickupTime' => 'required',
        //         'dropoffTime' => 'required'
        //     ];
        //     $amount = $vehicle->priceSetup->amount * $this->hours;
        //     $ammount = 0; // Initialize $ammount as an integer

        //     foreach ($this->selectedMenus as $id) {
        //         // Retrieve the amount for the given ID and add it to the total
        //         $menuAmount = EntertainmentMenu::where('id', $id)->value('amount');
        //         $ammount += $menuAmount;
        //     }
            // dd($ammount);
        // elseif ($vehicle->category_id == 2):
            $rules = [
                'pickupDate' => 'required',
                'pickupTime' => 'required',
                'dropoffDate' => 'required',
                'dropoffTime' => 'required'
            ];
            $amount = $vehicle->priceSetup->amount * $this->days;
        // endif;
        // $amount = $amount + $ammount;

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
        // if ($vehicle->category_id == 3):
        //     $booking = BookingOrder::create([
        //         'user_id' => Auth()->User()->id,
        //         'vehicle_id' => $this->reviewId,
        //         'pickupDate' => $this->pickupDate,
        //         'pickupTime' => $this->pickupTime,
        //         'dropoffDate' => $this->dropoffDate,
        //         'dropoffTime' => $this->dropoffTime,
        //         'duration' => $this->hours,
        //         'amount' => $amount,
        //         'payment_status' => 0,
        //         'status' => 0,
        //         'entertainmentMenu' => json_encode($this->selectedMenus)
        //     ]);
        // elseif ($vehicle->category_id == 2):
            $booking = BookingOrder::create([
                'user_id' => Auth()->User()->id,
                'vehicle_id' => $this->reviewId,
                'pickupDate' => $this->pickupDate,
                'pickupTime' => $this->pickupTime,
                'dropoffDate' => $this->dropoffDate,
                'dropoffTime' => $this->dropoffTime,
                'duration' => $this->days,
                'amount' => $amount,
                'payment_status' => 0,
                'status' => 0
            ]);
        // endif;
        if ($booking):
            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Vehicle Added Successfully',
            ]);
            return redirect()->route('checkout', ['reviewId' => $this->reviewId]);
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

    public function render()
    {
        // dd($this->pickupDate);
        if (Auth()->user()):
            $user = Auth()->user()->id;
            $order = BookingOrder::where('user_id', $user)->where('payment_status', 0)->get();

        else:
            $order = [];
        endif;
        $entertainmentMenu = EntertainmentMenu::all();
        $vehicle = Vehicle::where('id', $this->reviewId)->first();
        return view('livewire.home.review', ['vehicle' => $vehicle, 'days' => $this->days, 'orders' => $order, 'menus' => $entertainmentMenu])->layout('components.home.home-master-3');

    }
}
