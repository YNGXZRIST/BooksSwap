<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
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
Route::get('/places', [\App\Http\Controllers\PagesController::class, 'places'])->name('pages.places');
Route::group(['prefix' => 'registration'], function () {
    Route::get('/', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('register.index');
    Route::post('register', [\App\Http\Controllers\RegistrationController::class, 'sendCodeToMailForRegister'])->name('register.registration');
    Route::get('confirmCode', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterBlade'])->name('register.confirmRegisterBlade');
});
Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::get('add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
});
Route::group(['prefix' => 'authorization','controller'=>AuthController::class], function () {
    Route::get('/',  'index')->name('auth.index');
    Route::post('auth', 'authorization')->name('auth.authorization');
    Route::get('/notCompleted','notCompletedRegister')->name('auth.notCompleted');
});
Route::get('verify', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterCode'])->name('verify');
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');

        Route::post('updateAvatar', [\App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.update_avatar');
        Route::group(['prefix' => 'add'], function () {
            Route::get('/', [\App\Http\Controllers\GiveBooksController::class, 'add'])->name('profile.add_give.index');
            Route::post('submit', [\App\Http\Controllers\GiveBooksController::class, 'submit'])->name('profile.submit_give_books');
        });
    });
    Route::prefix('chat')->name('chat.')->controller(ChatController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getChats', 'getChats')->name('getChats');
        Route::get('/messages', 'getMessages')->name('getMessages');
        Route::post('/sendMessage', 'sendMessage')->name('sendMessage');
    });
    Route::group(['prefix' => 'giveBooks'], function () {
        Route::get('/', [\App\Http\Controllers\GiveBooksController::class, 'index'])->name('giveBooks.index');
    });
});
Route::get('getSubGenreByGenre', [\App\Http\Controllers\GiveBooksController::class, 'getSubGenreByGenre']);
