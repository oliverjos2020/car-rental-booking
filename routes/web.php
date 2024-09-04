<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\VendorViewDetails;
use App\Http\Livewire\VendorManagement;
use App\Http\Livewire\RoleManagement;
use App\Http\Livewire\CategoryManagement;
use App\Http\Livewire\LocationManagement;
use App\Http\Livewire\CarBrandManagement;
use App\Http\Livewire\PriceSetupManagement;
use App\Http\Livewire\UserManagement;
use App\Http\Livewire\Index;
use App\Http\Livewire\RegistrationType;
use App\Http\Livewire\Listing;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Review;
use App\Http\Livewire\BookingOrderManagement;
use App\Http\Livewire\MyVehicles;
use App\Http\Livewire\Profile;
use App\Http\Livewire\MyBookingOrders;
use App\Http\Livewire\PayPalPayment;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\RideBooking;
use App\Http\Livewire\RideResults;
use App\Http\Livewire\StartRide;
use App\Http\Livewire\EntertainmentMenuManagement;
use App\Http\Livewire\EntertainmentListing;
use App\Http\Livewire\EntertainmentCheckout;
use App\Http\Livewire\EntertainmentOrder;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RideOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/processPaypal/{amount}', [PaymentController::class, 'processPaypal'])->name('processPaypal');
Route::get('/processPaypalEntertainment/{amount}', [PaymentController::class, 'processPaypalEntertainment'])->name('processPaypalEntertainment');
Route::get('/processSuccess', [PaymentController::class, 'processSuccess'])->name('processSuccess');
Route::get('/processCancel', [PaymentController::class, 'processCancel'])->name('processCancel');
Route::get('/processSuccessEntertainment', [PaymentController::class, 'processSuccessEntertainment'])->name('processSuccessEntertainment');
Route::get('/processCancelEntertainment', [PaymentController::class, 'processCancelEntertainment'])->name('processCancelEntertainment');



// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Index::class)->name('index');
Route::get('/listing', Listing::class)->name('listing');
Route::get('/entertainment-listing', EntertainmentListing::class)->name('entertainmentListing');
Route::get('/review/{reviewId}', Review::class)->name('review');

Route::get('/ridebooking', RideBooking::class)->name('ridebooking');
Route::get('/ride-results', RideResults::class)->name('ride.results');
Route::post('/update-driver-location', [DriverController::class, 'updateLocation'])->middleware('auth');
Route::get('/get-nearby-drivers', [DriverController::class, 'getNearbyDrivers']);
Route::post('/order-ride', [RideOrderController::class, 'orderRide']);
Route::post('/cancel-ride', [RideOrderController::class, 'cancelRide']);
Route::get('/fetch-ride', [RideOrderController::class, 'fetchRide']);


Route::middleware(['auth'])->group(function () {
    Route::get('/entertainment-listing', EntertainmentListing::class)->name('entertainmentListing');
    Route::get('/entertainment-order', EntertainmentOrder::class)->name('entertainmentOrder');
    Route::get('/entertainment-checkout', EntertainmentCheckout::class)->name('entertainmentCheckout');
    Route::get('/ridebooking', RideBooking::class)->name('ridebooking');
    Route::get('/ride-results', RideResults::class)->name('ride.results');
    Route::get('/mybooking-orders', MyBookingOrders::class)->name('MyBookingOrders');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/dashboard2', Dashboard::class)->name('dashboard2');
    Route::get('/role', RoleManagement::class)->name('role');
    Route::get('/category', CategoryManagement::class)->name('category');
    Route::get('/location', LocationManagement::class)->name('location');
    Route::get('/brand', CarBrandManagement::class)->name('carbrand');
    Route::get('/priceSetup', PriceSetupManagement::class)->name('priceSetup');
    Route::get('/myVehicles', MyVehicles::class)->name('myVehicles');
    Route::get('/registration/{vehID}/{type}', RegistrationType::class)->name('regType');
    Route::get('/bookingOrder/{status}', BookingOrderManagement::class)->name('bookingOrder');
    Route::get('/start-ride/{vehId}', StartRide::class)->name('startRide');
    Route::get('/myOrders', [RideOrderController::class, 'driverOrders'])->name('driverOrders');
    Route::post('/acceptRequest', [RideOrderController::class, 'acceptRequest'])->name('acceptRequest');
    Route::post('/accept-ride', [RideOrderController::class, 'acceptRide'])->name('acceptRide');
    Route::post('/reject-ride', [RideOrderController::class, 'rejectRide'])->name('rejectRide');
    Route::middleware('can:admin-only')->group(function () {
        Route::get('/users', UserManagement::class)->name('userSetup');
        Route::get('/entertainment-menu', EntertainmentMenuManagement::class)->name('entertainmentMenu');
        Route::get('/vendorManagement/{type}', VendorManagement::class)->name('vendorSetup');
        Route::get('/vendor/{vehID}', VendorViewDetails::class)->name('viewVendor');
        Route::get('/profile/{userID}', Profile::class)->name('profile');

    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/create-payment', [PaymentController::class, 'createPayment'])->name('createPayment');
// Route::get('/status', [PaymentController::class, 'getPaymentStatus'])->name('status');

require __DIR__.'/auth.php';
