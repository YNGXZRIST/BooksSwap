<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Mail\SendAuthCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendCodeToMailAction extends Controller
{
    public function handle(string  $email)
    {

        $user=new User();
        $user->email=$email;
        $user->save();
        $code=rand(1111,9999);

        try{
            Mail::to($email)->send(new SendAuthCode($code));
        }catch (\Throwable $e){
            dd($e);
        }
        return $user;

    }

}
