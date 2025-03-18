<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SiteReviewsController;
use App\Http\Controllers\ProfileController;



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

// require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register')
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// Route::get('/{lang}', function(string $lang){
//     App::setLocale($lang);
//     return __("message.welcome");
// });





Route::group(['middleware' => ['InertiaMid','InertiaUser']], function(){
    Route::get('/checkemail', [UserController::class, 'checkemail'])->name('checkemail');
    Route::get('/search', [SearchController::class, 'search'])->name('searchResutl');
    Route::get('/', [UserController::class, 'show'])->name('home');
    Route::post('/addreview/{id}', [ReviewController::class, 'create']);
    Route::get('/review/{id}', [ReviewController::class, 'index']);
    Route::post('/sitereview', [SiteReviewsController::class, 'store'])->name('sitereview');

    Route::get('/register', [AgencyController::class, 'showRegister'])->name('Agency.create');
    Route::post('register', [AgencyController::class, 'store'])->name('Agency.register');
    Route::post('RegisterUser', [LoginController::class, 'register'])->name('register');
    Route::post('/LoginUser', [LoginController::class, 'authenticate'])->name('login');
    Route::get('logoutUser', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('/rent/{id}', [CarController::class, 'show'])->name('car.rent');
    Route::get('/fav/delete/{id}', [FavoriteController::class, 'delete']);
    Route::get('/fav/add/{id}', [FavoriteController::class, 'add']);
    Route::post('/update', [ProfileController::class, 'update'])->name('update.user');
    Route::post('/payment', [PaymentController::class, 'Payment'])->name('pay');
    Route::get('/confirm/{id}/{token}', [UserController::class, 'confrimaccount'])->name('confirmac');
    Route::post('/check-email', [UserController::class, 'checkemail']);
    Route::resource('/review', ReviewController::class);
 });

