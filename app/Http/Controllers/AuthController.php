<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use Illuminate\Http\Request;

class AuthController extends Controller
{
public function index(){
    return view('pages.auth.auth');
}
public function authorization(Request $request,LoginAction $action){
   return $action->handle($request);

}
public function notCompletedRegister(){
    return view('pages.registrationSuccess');
}
}
