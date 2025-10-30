<?php

use App\Http\Livewire\Index;
use App\Http\Livewire\Review;
use App\Http\Livewire\Listing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\StartRide;
use App\Http\Livewire\DecideTrip;
use App\Http\Livewire\MyVehicles;
use App\Http\Livewire\TestDriver;
use App\Http\Livewire\RideBooking;
use App\Http\Livewire\RideResults;
use App\Http\Livewire\PayPalPayment;
use App\Http\Livewire\RoleManagement;
use App\Http\Livewire\TestDirections;
use App\Http\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MyBookingOrders;
use App\Http\Livewire\RegistrationType;
use App\Http\Livewire\VendorManagement;
use App\Http\Livewire\VendorViewDetails;
use App\Http\Livewire\CarBrandManagement;
use App\Http\Livewire\CategoryManagement;
use App\Http\Livewire\EntertainmentOrder;
use App\Http\Livewire\LocationManagement;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\EntertainmentListing;
use App\Http\Livewire\PriceSetupManagement;
use App\Http\Livewire\EntertainmentCheckout;
use App\Http\Controllers\RideOrderController;
use App\Http\Livewire\BookingOrderManagement;
use App\Http\Livewire\EntertainmentMenuManagement;
use App\Http\Livewire\VoucherManagement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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



Route::get('/preview-temp/{filename}', function ($filename) {
    $tmpPath = storage_path('framework/livewire-tmp');

    // Create the directory if it doesn't exist
    if (!File::exists($tmpPath)) {
        File::makeDirectory($tmpPath, 0755, true);
    }

    $path = $tmpPath . '/' . $filename;

    // Return 404 if the file still doesn't exist
    if (!file_exists($path)) {
        abort(404, 'Temp file not found.');
    }

    $mimeType = mime_content_type($path);

    return Response::file($path, [
        'Content-Type' => $mimeType,
    ]);
})->name('custom.preview');

Route::get('/', Index::class)->name('index');
Route::get('/listing', Listing::class)->name('listing');
Route::get('/entertainment-listing', EntertainmentListing::class)->name('entertainmentListing');
Route::get('/review/{reviewId}', Review::class)->name('review');

Route::get('/ridebooking', RideBooking::class)->name('ridebooking');
Route::post('/update-driver-location', [DriverController::class, 'updateLocation'])->middleware('auth');
Route::get('/get-nearby-drivers', [DriverController::class, 'getNearbyDrivers']);
Route::post('/order-ride', [RideOrderController::class, 'orderRide']);
Route::post('/cancel-ride', [RideOrderController::class, 'cancelRide']);
Route::get('/fetch-ride', [RideOrderController::class, 'fetchRide']);
Route::get('/entertainment-listing', EntertainmentListing::class)->name('entertainmentListing');

Route::middleware(['auth'])->group(function () {

    Route::get('/voucher', VoucherManagement::class)->name('voucher');
    Route::get('/booking', RideResults::class)->name('ride.results');
    Route::get('/test-direction', TestDirections::class)->name('testDirection');
    Route::get('/test-driver', TestDriver::class)->name('testDriver');
    Route::post('/driver/toggle-status', [DriverController::class, 'toggleStatus']);
    Route::post('/request-ride', [DriverController::class, 'requestRide']);
    Route::post('/get-nearby-vehicles', [DriverController::class, 'getNearbyVehicles']);
    Route::post('/select-vehicle', [DriverController::class, 'selectVehicle']);
    Route::post('/acceptRide', [DriverController::class, 'acceptRide']);
    Route::post('/rejectRide', [DriverController::class, 'rejectRide']);
    Route::post('/broadcast-driver-location', [DriverController::class, 'broadcastDriverLocation']);


    Route::get('/trip-decide', DecideTrip::class)->name('entertainmentOrder');
    Route::get('/entertainment-order', EntertainmentOrder::class)->name('entertainmentOrder');
    Route::get('/entertainment-checkout', EntertainmentCheckout::class)->name('entertainmentCheckout');
    Route::get('/ridebooking', RideBooking::class)->name('ridebooking');
    Route::get('/ride-results', RideResults::class)->name('ride.results');
    Route::get('/mybooking-orders/{type}', MyBookingOrders::class)->name('MyBookingOrders');
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
