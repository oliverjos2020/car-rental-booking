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

Route::middleware(['auth'])->get('/dashboard2', Dashboard::class)->name('dashboard');


Route::middleware(['auth'])->get('/role', RoleManagement::class)->name('role');
Route::middleware(['auth'])->get('/category', CategoryManagement::class)->name('category');
Route::middleware(['auth'])->get('/location', LocationManagement::class)->name('location');
Route::middleware(['auth'])->get('/brand', CarBrandManagement::class)->name('carbrand');
Route::middleware(['auth'])->get('/priceSetup', PriceSetupManagement::class)->name('priceSetup');
Route::middleware(['auth', 'can:admin-only'])->get('/users', UserManagement::class)->name('userSetup');
Route::middleware(['auth'])->get('/registration/{vehID}/{type}', RegistrationType::class)->name('regType');
Route::middleware(['auth', 'can:admin-only'])->get('/vendorManagement/{type}', VendorManagement::class)->name('userSetup');
Route::middleware(['auth', 'can:admin-only'])->get('/vendor/{vehID}', VendorViewDetails::class)->name('viewVendor');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
