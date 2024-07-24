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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Index::class)->name('index');
Route::get('/listing', Listing::class)->name('listing');
Route::get('/review/{reviewId}', Review::class)->name('review');
Route::get('/mybooking-orders', MyBookingOrders::class)->name('MyBookingOrders');
Route::get('/payment', PaypalPayment::class)->name('paypalPayment');
Route::post('/create-order', [Review::class, 'createOrder'])->name('createOrder');
Route::post('/on-approve', [Review::class, 'onApprove'])->name('onApprove');
Route::get('/paypal/success', [Review::class, 'onApprove'])->name('paypal.success');
Route::get('/paypal/cancel', function () {
    return 'Payment cancelled';
})->name('paypal.cancel');
Route::get('/paypal/client-token', [Review::class, 'getClientToken'])->name('paypal.clientToken');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard2', Dashboard::class)->name('dashboard2');
    Route::get('/role', RoleManagement::class)->name('role');
    Route::get('/category', CategoryManagement::class)->name('category');
    Route::get('/location', LocationManagement::class)->name('location');
    Route::get('/brand', CarBrandManagement::class)->name('carbrand');
    Route::get('/priceSetup', PriceSetupManagement::class)->name('priceSetup');
    Route::get('/myVehicles', MyVehicles::class)->name('myVehicles');
    Route::get('/registration/{vehID}/{type}', RegistrationType::class)->name('regType');
    Route::get('/bookingOrder/{status}', BookingOrderManagement::class)->name('bookingOrder');
    Route::middleware('can:admin-only')->group(function () {
        Route::get('/users', UserManagement::class)->name('userSetup');
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