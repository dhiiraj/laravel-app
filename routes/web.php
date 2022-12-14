<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialAuthFacebookController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

use Illuminate\Support\Facades\Route;

Route::get('/redirect', [SocialAuthFacebookController::class, 'redirect']);
Route::get('/callback', [SocialAuthFacebookController::class, 'callback']);

Route::get('/home', [DashboardController::class, 'index'])->name('home');
