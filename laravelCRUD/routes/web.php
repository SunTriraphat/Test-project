<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\userProfileController;


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

Route::resource('jobs',jobController::class);
Route::post('/jobs/store', [App\Http\Controllers\jobController::class, 'store'])->name('jobs.store');
Route::put('/jobs/{id}/edit/{detail}/{reference}', [App\Http\Controllers\jobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}/destroy', [App\Http\Controllers\jobController::class, 'destroy'])->name('jobs.destroy');

Route::resource('addresses',addressController::class);
Route::post('/addresses/store', [App\Http\Controllers\addressController::class, 'store'])->name('addresses.store');
Route::put('/addresses/{id}/edit/{detail}/{reference}', [App\Http\Controllers\addressController::class, 'update'])->name('addresses.update');
Route::delete('/addresses/{id}/destroy', [App\Http\Controllers\addressController::class, 'destroy'])->name('addresses.destroy');

Route::resource('userProfile',userProfileController::class);
Route::post('/userProfile/store', [App\Http\Controllers\userProfileController::class, 'store'])->name('userProfile.store');
Route::put('/userProfile/{id}/edit/{name}/{email}', [App\Http\Controllers\userProfileController::class, 'update'])->name('userProfile.update');
Route::delete('/userProfile/{id}/destroy', [App\Http\Controllers\userProfileController::class, 'destroy'])->name('userProfile.destroy');



Route::get('/', function () {
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home',[HomeController::class,'adminHome'])->name('admin.home')->middleware('is_admin');
