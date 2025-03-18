<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\AuthAdminController;

Route::get('/login', [AdminController::class, 'loginShow'])
    ->middleware('guest')
->name('loginAdmin');


Route::group(['middleware' => 'session'], function () {
    Route::post('/login', [AuthAdminController::class, 'authenticateAdmin'])
->name("login.post");
});



Route::group(['middleware' => ['AuthAdmin','InertiaAdmin','InertiaMid']], function(){
    Route::get('/', [AdminController::class, 'show'])->name('homeAdmin');
    Route::get('/statistic', [AdminController::class, 'stats'])->name('statistic');
    Route::get('/AgenciesList', [AdminController::class, 'listag'])->name('AgenciesList');
    Route::get('/pending', [AdminController::class, 'pending'])->name('pending');
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::get('/rentinvoice', [AdminController::class, 'rent'])->name('rent');
    Route::post('/new', [AgencyController::class, 'store'])->name('Agency.store');
    Route::get('/new', [AdminController::class, 'add'])->name('addAgency');
    Route::delete("/delete", [AgencyController::class, 'delete'])->name('delete.agency');
    Route::post("/accept", [AgencyController::class, 'accept'])->name('accept.agency');
    Route::get("/download/users", [AdminController::class, 'downloadusers']);
    Route::get("/download/agencies", [AdminController::class, 'downloadagencies']);
    Route::get("/download/rents", [AdminController::class, 'downloadrents']);
 });
