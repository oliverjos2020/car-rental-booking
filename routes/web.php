<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TodoList;
use App\Http\Livewire\RegisterUser;
use App\Http\Livewire\RoleManagement;
use App\Http\Livewire\CategoryManagement;
use App\Http\Livewire\LocationManagement;
use App\Http\Livewire\CarBrandManagement;
use App\Http\Livewire\PriceSetupManagement;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard2', function () {
    return view('dashboard/dashboard2');
});


Route::middleware(['auth'])->get('/role', RoleManagement::class)->name('role');
Route::middleware(['auth'])->get('/category', CategoryManagement::class)->name('category');
Route::middleware(['auth'])->get('/location', LocationManagement::class)->name('location');
Route::middleware(['auth'])->get('/brand', CarBrandManagement::class)->name('carbrand');
Route::middleware(['auth'])->get('/priceSetup', PriceSetupManagement::class)->name('priceSetup');
// Route::get('/todo', TodoList::class)->name('todo');
// Route::get('/register-user', RegisterUser::class)->name('registeruser');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
