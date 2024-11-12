<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:web');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::group(['prefix' => 'traveling'], function () {
    Route::get('about/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'about'])->name('traveling.about');

    //Booking
    Route::get('reservation/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'makeReservations'])->name('traveling.reservation');
    Route::post('reservation/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'storeReservations'])->name('traveling.reservation.store');

    //pay
    Route::get('pay', [App\Http\Controllers\Traveling\TravelingController::class, 'payWithPayPal'])->name('traveling.pay')->middleware('check.for.price');
    Route::get('success', [App\Http\Controllers\Traveling\TravelingController::class, 'success'])->name('traveling.success')->middleware('check.for.price');

    //Deals
    Route::get('deals', [App\Http\Controllers\Traveling\TravelingController::class, 'deals'])->name('traveling.deals');
    Route::any('search-deals', [App\Http\Controllers\Traveling\TravelingController::class, 'searchDeals'])->name('traveling.deals.search');
});


//user pages
Route::get('user/my-bookings', [App\Http\Controllers\Users\UsersController::class, 'bookings'])->name('user.bookings')->middleware('auth:web');




///Admins panel
Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.login');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    // Route::get('index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admin.dashboard');
    Route::match(['get', 'post'], 'index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admin.dashboard');

    //admins
    Route::get('all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admin.all.admins');
    Route::get('create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admin.create');
    Route::post('create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admin.store');
    Route::get('delete-admins/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteAdmins'])->name('admin.delete');



    //countries
    Route::get('all-countries', [App\Http\Controllers\Admins\AdminsController::class, 'allCountries'])->name('admin.all.countries');
    Route::get('create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'createCountries'])->name('admin.create.countries');
    Route::post('create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'storeCountries'])->name('admin.store.countries');
    Route::get('delete-countries/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCountries'])->name('admin.delete.countries');


    //Cities
    Route::get('all-cities', [App\Http\Controllers\Admins\AdminsController::class, 'allCities'])->name('admin.all.cities');
    Route::get('create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'createCities'])->name('admin.create.cities');
    Route::post('create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'storeCities'])->name('admin.store.cities');
    Route::get('delete-cities/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCities'])->name('admin.delete.cities');


    //Bookings
    Route::get('all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])->name('admin.all.bookings');
    Route::get('edit-status/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editStatus'])->name('bookings.edit.status');
    Route::post('update-status/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateStatus'])->name('bookings.update.status');
    Route::get('delete-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBookings'])->name('bookings.delete');
});
