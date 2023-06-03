<?php

use App\Events\SendMessage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikeController;
use App\Models\Chats;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    Route::post('register', [\App\Http\Controllers\RegistrationController::class, 'sendCodeToMailForRegister'])
        ->name('register.registration');
    Route::get('confirmCode', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterBlade'])
        ->name('register.confirmRegisterBlade');
});
Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::get('add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('remove', [\App\Http\Controllers\CartController::class, 'removeCart'])->name('cart.remove');
});
Route::group(['prefix' => 'authorization', 'controller' => AuthController::class], function () {
    Route::get('/', 'index')->name('auth.index');
    Route::post('auth', 'authorization')->name('auth.authorization');
    Route::get('/notCompleted', 'notCompletedRegister')->name('auth.notCompleted');
});
Route::get('verify', [\App\Http\Controllers\RegistrationController::class, 'confirmRegisterCode'])->name('verify');
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');

        Route::post('updateAvatar', [\App\Http\Controllers\ProfileController::class, 'updateAvatar'])
            ->name('profile.update_avatar');
        Route::group(['prefix' => 'add'], function () {
            Route::get('/', [\App\Http\Controllers\GiveBooksController::class, 'add'])->name('profile.add_give.index');
            Route::post('submit', [\App\Http\Controllers\GiveBooksController::class, 'submit'])
                ->name('profile.submit_give_books');
        });
        Route::group(['prefix' => 'giveBooks'], function () {
            Route::get('/remove', [\App\Http\Controllers\GiveBooksController::class, 'remove']);
        });


        Route::group(['prefix' => 'swap'], function () {
            Route::get('/add', [\App\Http\Controllers\SwapController::class, 'addIndex'])->name('profile.swap_add');
            Route::post('/submit', [\App\Http\Controllers\SwapController::class, 'submit'])->name('profile.submit_swap_books');
            Route::get('/remove', [\App\Http\Controllers\SwapController::class, 'remove']);
        });
        Route::group(['prefix' => 'crossing'], function () {
            Route::get('/add', [\App\Http\Controllers\CrossingController::class, 'addIndex']);
            Route::post('/submit', [\App\Http\Controllers\CrossingController::class, 'submit'])->name('profile.submit_crossing_books');


        });
    });
    Route::prefix('chat')->name('chat.')->controller(ChatController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getChats', 'getChats')->name('getChats');
        Route::get('/messages', 'getMessages')->name('getMessages');
        Route::post('/send-message', 'sendMessage')->name('sendMessage');
        Route::post('/send-message', function () {
            $sender = Auth::user()->id ?? request('senderId');
            $receiver = request('receiver');
            $content = request('content');
            $chatsCount = \App\Models\Chats::query()
                ->where([['first_user_id', $receiver], ['second_user_id', $sender]])
                ->orWhere([['first_user_id', $sender], ['second_user_id', $receiver]])->count();
            if ($chatsCount === 0) {
                $chat = new \App\Models\Chats();
                $chat->first_user_id = $sender;
                $chat->second_user_id = $receiver;
                $chat->save();

            } else {
                $chat = \App\Models\Chats::query()
                    ->where([['first_user_id', $receiver], ['second_user_id', $sender]])
                    ->orWhere([['first_user_id', $sender], ['second_user_id', $receiver]])->first();
            }

            $message = new Messages;
            $message->sender = $sender;
            $message->receiver = $receiver;
            $message->content = $content;
            $message->chat_id = $chat->id;
            $message->save();
            $incomingMessage = Messages::query()->with(['senderUser', 'receiverUser'])->where('id', $message->id)
                ->first();


            broadcast(new SendMessage($incomingMessage))->toOthers();

            return response()->json(['success' => true]);
        });
        Route::get('/users', function () {

            $userId = Auth::user()->id;
            $usersChatIds = Chats::query()->select('first_user_id', 'second_user_id')
                ->where('first_user_id', $userId)->orWhere('second_user_id', $userId)->orderBy('updated_at', 'DESC')
                ->get();

            $usersChatIds = collect($usersChatIds->toArray())->flatten()->all();
            $users = User::query()->whereIn('id', array_unique($usersChatIds))->whereNot('id', $userId)->get();

            return response()->json(['users' => $users]);
        });
        Route::get('/messages/{receiver}', function ($receiver) {
            $sender = Auth::user()->id;

            $messages = Messages::query()->with(['senderUser', 'receiverUser'])->where(function ($query) use (
                $sender,
                $receiver
            ) {
                $query->where('sender', $sender)->where('receiver', $receiver);
            })->orWhere(function ($query) use ($sender, $receiver) {
                $query->where('sender', $receiver)->where('receiver', $sender);
            })->orderBy('created_at')->get();


            return response()->json(['messages' => $messages]);
        });
        Route::get('/getChat/{receiver}', function () {

            $userId = Auth::user()->id;

            $receiver = request('receiver');

            $chatsCount = \App\Models\Chats::query()
                ->where([['first_user_id', $receiver], ['second_user_id', $userId]])
                ->orWhere([['first_user_id', $userId], ['second_user_id', $receiver]])->count();
            if ($chatsCount === 0) {
                $chat = new \App\Models\Chats();
                $chat->first_user_id = $userId;
                $chat->second_user_id = $receiver;
                $chat->save();

            } else {
                $chat = \App\Models\Chats::query()
                    ->where([['first_user_id', $receiver], ['second_user_id', $userId]])
                    ->orWhere([['first_user_id', $userId], ['second_user_id', $receiver]])->first();
            }

            return response()->json(['chatId' => $chat]);
        });
    });

});
Route::group(['prefix' => 'giveBooks'], function () {
    Route::get('/', [\App\Http\Controllers\GiveBooksController::class, 'index'])->name('giveBooks.index');
    Route::get('{id}', [\App\Http\Controllers\GiveBooksController::class, 'aboutBook'])->name('giveBooks.aboutBook');

});
Route::group(['prefix' => 'swap'], function () {
    Route::get('/', [\App\Http\Controllers\SwapController::class, 'index'])->name('swap.index');
    Route::get('{id}', [\App\Http\Controllers\SwapController::class, 'about'])->name('swap.about');
});
Route::group(['prefix' => 'crossing'], function () {
    Route::get('/', [\App\Http\Controllers\CrossingController::class, 'index'])->name('crossing.index');
    Route::get('/{id}', [\App\Http\Controllers\CrossingController::class, 'about'])->name('crossing.about');

});
Route::redirect('/public/chat', '/chat', 301);
Route::get('getSubGenreByGenre', [\App\Http\Controllers\GiveBooksController::class, 'getSubGenreByGenre']);
Route::get('/getCities/{string}', [\App\Http\Controllers\ProfileController::class, 'getCities']);
//Route::group(['prefix'=>'like'],function (){
//    Route::get('',[LikeController::class],'index')->name('like.index');
//});
