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

    public function getMessages(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        $userId = $request->user()->id;
        return Messages::query()->with('user')->where('user_id', $userId)->orWhere('message_to_id', $userId)->get();
    }

    public function getChats(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {

        $userId = $request->user()->id;

        $usersIds = Messages::query()->select('user_id', 'message_to_id')
            ->where('message_to_id',$userId)->orWhere( 'user_id', $userId)->orderBy('updated_at','DESC')->get();

        $usersIds = collect($usersIds->toArray())->flatten()->all();


        return User::query()->whereIn('id', array_unique($usersIds))->whereNot('id',$userId)->get();
    }

    public function sendMessage(MessageFormRequest $request)
    {

        $message = $request->user()->messages()->create($request->validated());

        broadcast(new MessageSend($request->user(), $message));
        return $message;
    }

}
