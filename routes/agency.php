<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\AuthAgencyController;
use App\Http\Controllers\carController;
use App\Http\Controllers\OptionController;

Route::get('/login', [AgencyController::class, 'showLogin'])->middleware('guest');

Route::group(['middleware' => 'session'], function () {
    Route::post('/login', [AuthAgencyController::class, 'authenticateAgency'])
    ->name('loginAgency');
});

Route::group(['middleware' => ['AgencyAuth','InertiaAgency']], function () {
  Route::get('/', [AgencyController::class, 'show'])->name('agencyHome');
  Route::get('/api/info', [AgencyController::class, 'getInfo'])->name('agencyInfo');
  Route::get('/statistics', [AgencyController::class, 'stats'])->name('statistics');
  Route::get('/carsList', [CarController::class, 'index'])->name('carslist');
  Route::get('/newCar', [CarController::class, 'create'])->name('newCar');
  Route::get('/rents', [AgencyController::class, 'allRent'])->name('rents');
  Route::post('add', [CarController::class, 'store']);
  Route::get('/car/delete/{car}', [CarController::class, "destroy"])->name("car.delete");
  Route::post('/car/update/', [CarController::class, "update"])->name("car.update");
  Route::get('/waiting', [AgencyController::class, "waiting"])->name("rent.waiting");
  Route::get('/acceptewaiting', [AgencyController::class, "acceptwaiting"])->name("rent.acceptewaiting");
  Route::get('/refusewaiting', [AgencyController::class, "deletewaiting"])->name("rent.refusewaiting");
  Route::get('/optionList', [OptionController::class, 'index'])->name('option.index');
  Route::get('/newOption', [OptionController::class, 'create'])->name('option.create');
  Route::post('new', [OptionController::class, 'store'])->name('option.store');
  Route::get('/option/{option}', [OptionController::class, "destroy"])->name("option.delete");
  //Route::resource('/option', OptionController::class);
  Route::post('/logout', [AuthAgencyController::class, 'logout'])->name('agency.logout');
});

