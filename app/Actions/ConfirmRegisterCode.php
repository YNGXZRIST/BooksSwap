<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationStack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConfirmRegisterCode extends Controller
{
    public function handle(Request $request)
    {

        $validated = $request->validate(['token' => 'required','userId'=>'required']);

//        $codeModel = VerificationStack::where('user_id', $validated['userId'])->where('code',$validated['token'])->orderBy('id', 'DESC')->first();
//        $codeModel->delete();
        $userModel = User::where('id', $validated['userId'])->first();
        $userModel->email_verified_at = Carbon::now()->getTimestamp();
        $userModel->save();
        Auth::login($userModel);
        $token = $userModel->createToken('authToken')->accessToken;
        $cookie = cookie('token', $token, 60 * 24 * 24);
        return response(view('pages.registration.successVerify'),
        )->withCookie($cookie);
//        return view('pages.registration.successVerify');

    }
}
