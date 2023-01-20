<?php

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
Route::get('/places',[\App\Http\Controllers\PagesController::class,'places'])->name('pages.places');
Route::group(['prefix' => 'registration'], function () {
    Route::get('/', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('register.index');
    Route::post('register', [\App\Http\Controllers\RegistrationController::class, 'sendCodeToMailForRegister'])->name('register.registration');
//    Route::post('confirmCode', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterCode'])->name('register.confirmCode');
});
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'registration'], function () {
        Route::post('confirmCode', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterCode'])->name('register.confirmCode');
    });
});
