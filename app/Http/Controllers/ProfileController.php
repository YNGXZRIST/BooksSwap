<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
   {
      $user=Auth::user();
       return view('pages.profile.index')->with(compact('user'));
   }
   public function updateAvatar(Request $request){
       dd($request);
   }
}
