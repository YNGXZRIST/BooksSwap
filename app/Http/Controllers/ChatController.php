<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Http\Requests\MessageFormRequest;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('pages.chat.index');
    }

    public function getMessages(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Messages::query()->with('user')->get();
    }
    public function getChats(): \Illuminate\Database\Eloquent\Collection|array
    {
        $user= User::query()->with('messages')->get();
        dd($user);
    }
    public function sendMessage(MessageFormRequest $request)
    {

        $message = $request->user()->messages()->create($request->validated());

        broadcast(new MessageSend($request->user(),$message));
        return $message;
    }

}
