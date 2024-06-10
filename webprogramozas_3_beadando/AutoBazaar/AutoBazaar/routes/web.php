<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Models\Car;
use App\Models\User;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\Fuel;
use App\Models\Modell;
use App\Models\Transmission;

Route::get('/', function () {
    $brand = Brand::all();
    $condition = Condition::all();
    $fuel = Fuel::all();
    $model = Modell::all();
    $transmission = Transmission::all();
    $cars = Car::with('brand', 'condition', 'fuel', 'modell', 'transmission')->get();
    return view('welcome', ['cars'=>$cars,'brand'=>$brand,'model'=>$model,'condition'=>$condition,'fuel'=>$fuel,'transmission'=>$transmission]);
})->name('main');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/sellcar', [AuthManager::class, 'sellcar'])->name('sellcar');
Route::post('/sellcar', [AuthManager::class, 'sellcarPost'])->name('sellcar.post');

Route::get('/advertisement/{id}', [AuthManager::class, 'viewAdvertisement'])->name('advertisement');
Route::delete('/advertisement/{id}', [AuthManager::class, 'deleteAdvertisement'])->name('advertisement.delete');

Route::get('/myprofile', [AuthManager::class, 'myprofile'])->name('myprofile');
Route::post('/myprofile', [AuthManager::class, 'myprofileUpdate'])->name('myprofile.post');
Route::delete('/myprofile', [AuthManager::class, 'myprofileDelete'])->name('myprofile.delete');