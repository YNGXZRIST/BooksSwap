<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\SwapCreateRequest;
use App\Models\Cities;
use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwapCreateAction extends Controller
{
    public function handle(SwapCreateRequest $request)
    {

        $bookAuthor=$request['bookAuthor'];
        $bookName=$request['bookName'];
        $description=$request['description']??null;
        $bookAuthor2=$request['bookAuthor2']??null;
        $bookName2=$request['bookName2']??null;
        $cityName=$request['city'];


        if (isset($request['swapUpdateId']) && $request['swapUpdateId']!==''){
        $swap=Swap::where('id',$request['swapUpdateId'])->where('user_id',Auth::id())->first();
        $city=Cities::where('id',$swap->city_id)->first();
        }else{
            $swap=new Swap();
            $city=Cities::query()->firstOrCreate(['name'=>$cityName]);

        }
        $cityId=$city->id;
        $swap->user_id=Auth::id();
        $swap->given_book_author=$bookAuthor;
        $swap->given_book_name=$bookName;
        $swap->given_book_description=$description;
        $swap->desired_book_author=$bookAuthor2;
        $swap->desired_book_name=$bookName2;
        $swap->city_id=$cityId;
        $swap->status=Swap::STATUS_CREATED;
        if($swap->save()){
            return redirect()->route('swap.index')->with(['isSave'=>true]);

        }else{
            return back()->withErrors(['msg' => 'Не удалось сохранить. Попробуйте позже.']);
        }
    }
}
