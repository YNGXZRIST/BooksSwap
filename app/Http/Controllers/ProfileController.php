<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\GiveBooksModel;
use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
   {
      $user=Auth::user();
      $userGiveBooks=GiveBooksModel::query()->where('user_id',$user->id)
       ->with(['images','mainImage'])->orderBy('id','DESC')->limit(10)->get()->toArray();
      $userSwap=Swap::query()->where('status', Swap::STATUS_CREATED)->where('user_id',$user->id)->
      orderBy('id', 'Desc')->limit(10)->get()->toArray();

       return view('pages.profile.index')->with(compact('user','userGiveBooks','userSwap'));
   }
   public function updateAvatar(Request $request){
       dd($request);
   }
   public function getCities(string $city): \Illuminate\Http\JsonResponse
   {

    $city=Cities::query()->where('name', 'like','%'.$city.'%')->first()->name??'';

       return response()->json( $city);

   }
}
