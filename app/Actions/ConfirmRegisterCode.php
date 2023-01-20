<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationStack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConfirmRegisterCode extends Controller
{
    public function handle(Request $request)
    {
        $validated = $request->validate(['code' => 'required|max:6']);
        $user = auth()->user();
        $codeCount = VerificationStack::where('user_id', $user->id)->count();
        if ($codeCount === 0) return back()->withErrors('Заявка на регистрацию не найдена');
        $codeModel = VerificationStack::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        $code = $codeModel->code;
        if ($validated['code'] !== $code) return Redirect::back()->withErrors(['msg'=>'Неверно введен код']);
        $codeModel->delete();
        $userModel = User::where('id', $user->id)->first();
        $userModel->email_verified_at = Carbon::now()->getTimestamp();
        $userModel->save();

        return redirect()->to('/')->send();

    }
}
