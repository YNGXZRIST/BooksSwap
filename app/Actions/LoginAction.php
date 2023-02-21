<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAction extends Controller
{

    public function handle(Request $request)
    {
        $validate = $request->validate(['email' => 'required|email|max:255', 'password' => 'required']);
        $userCount = User::where('email', $validate['email'])->count();
        if ($userCount === 0) {
            return back()->withErrors(['msg' => 'Пользователь не найден']);
        }
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            $user = User::where('email', $validate['email'])->first();
            if (!$user->email_verified_at) {
                redirect(route('auth.notCompleted'));
            }
            return redirect(route('profile.index'));
        }
        return back()->withErrors([
            'msg' => 'Неверно введены данные',
        ]);
    }
}
