<?php

namespace App\Http\Controllers;

use App\Models\GiveBooksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
   {
      $user=Auth::user();
      $userGiveBooks=GiveBooksModel::query()->where('user_id',$user->id)
       ->with(['images','mainImage'])->orderBy('id','DESC')->limit(5)->get()->toArray();

       return view('pages.profile.index')->with(compact('user','userGiveBooks'));
   }
   public function updateAvatar(Request $request){
       dd($request);
   }
}
