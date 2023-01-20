<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Mail\SendAuthCode;
use App\Models\User;
use App\Models\VerificationStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegistrationAction extends Controller
{

    public function handle(Request $request)
    {
        $validated = $request->validate(['email' => 'required|string|max:255|unique:mysql.u1781141_bookswap.users,email',
            'password' => 'required|max:255', 'username' => 'required|max:255']);
        $user = new User();
        $user->name = $validated['username'];
        $user->email = $validated['email'];
        $user->password = app('hash')->make($validated['password']);
        $user->save();
        $code = rand(1111, 9999);
        Mail::to($validated['email'])->send(new SendAuthCode($code));
        $verificationEmail = new VerificationStack();
        $verificationEmail->user_id = $user->id;
        $verificationEmail->code = $code;
        $verificationEmail->save();
        Auth::login($user);
        $token = $user->createToken('authToken')->accessToken;
        $cookie = cookie('token', $token, 60 * 24 * 24);

        return response(route('register.confirmation_code'),
        )->withCookie($cookie);
    }
}