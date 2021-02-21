<?php

use App\Http\Livewire\ContractorID;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

Route::middleware(['auth:sanctum', 'verified'])->get('/contractor/companydetails', function () {
    return view('companydetails');
})->name('companydetails');

Route::middleware(['auth:sanctum', 'verified'])->get('/contractor', function () {
    return view('contractor');
})->name('contractor');

Route::middleware(['auth:sanctum', 'verified'])->get('/contractor/{id}', ContractorID::class)->name('ContractorID');

Route::middleware(['auth:sanctum', 'verified'])->get('/adminsettings/', function () {
    return view('adminsettings');
})->name('adminsettings');


