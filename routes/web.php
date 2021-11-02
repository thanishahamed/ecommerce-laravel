<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\AdminDashboard;
use App\Http\Livewire\HomeController;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\ProductDescriptionComponent;
use App\Http\Livewire\SearchDisplay;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', HomeComponent::class)->name('home');


Route::get('/test', function () {
    $user = User::findOrFail(1);
    $user->address;
    $user->paymentMethods;
    return ($user);
});

// Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{id}', ProductDescriptionComponent::class)->name('description');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/about-us', AboutUsComponent::class)->name('about-us');
Route::get('/contact-us', ContactUsComponent::class)->name('contact-us');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/search/{searchString}', SearchDisplay::class)->name('search');
Route::get('/admin', AdminDashboard::class)->name('admin');
Route::get('/datatable', [UserController::class, 'index'])->name('users.index');
