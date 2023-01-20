<?php

namespace App\Http\Controllers;

use App\Actions\ConfirmRegisterCode;
use App\Actions\RegistrationAction;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('pages.registration');
    }

    public function sendCodeToMailForRegister(Request $request, RegistrationAction $action)
    {

        return $action->handle($request);
    }
    public function confirmRegisterCode(Request $request,ConfirmRegisterCode $action){
        return $action->handle($request);

    }
}
