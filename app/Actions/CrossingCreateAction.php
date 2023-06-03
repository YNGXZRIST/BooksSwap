<?php

namespace App\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrossingCreateRequest;
use App\Http\Requests\SwapCreateRequest;
use App\Models\Cities;

use App\Models\CrossingBookModel;
use App\Models\CrossingModel;
use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrossingCreateAction extends Controller
{
    public function handle(CrossingCreateRequest $request): \Illuminate\Http\RedirectResponse
    {

       $crossingCount= CrossingModel::query()->where('isbn',$request['bookISBN'])->count();
        if ($crossingCount===0){
            $crossing = new CrossingModel();
        }else{
            $crossing= new CrossingBookModel();
            $crossing->crossing_id=CrossingModel::query()->where('isbn',$request['bookISBN'])->first()->id;
            CrossingModel::query()->where('isbn',$request['bookISBN'])->update(['updated_at'=>now()]);
        }

        $crossing->user_id = Auth::id();
        $city = Cities::query()->firstOrCreate(['name' => $request['city']]);
        if ($crossingCount===0) {
            $crossing->author = $request['bookAuthor'];
            $crossing->name = $request['bookName'];
            $crossing->isbn = $request['bookISBN'] ?? null;
        }
        $crossing->location = $request['bookLocation'];
        $crossing->location_description = $request['descriptionPlaces']??null;
        if (in_array($request['status'], CrossingModel::TYPES_CROSSING)) {
            $status = $request['status'];
        } else {
            $status = $crossing::TYPE_LEFT;
        }
        $crossing->status = $status;
        $crossing->city_id = $city->id;
        $cover = $request->file('bookCover');

        if ($cover !== null) {
            $path = $cover->store('/images/crossing', ['disk' => 'my_files']);
            $crossing->cover_url=$path;
        }else{
           $path= CrossingModel::query()->where(['isbn'=>$request['bookISBN']])->whereNotNull('cover_url')->first();
           if (isset($path->cover_url)){
               $crossing->cover_url=$path->cover_url;
           }
        }

        if($crossing->save()){
            return redirect()->route('crossing.index')->with(['isSave'=>true]);
        }else{
            return back()->withErrors(['msg' => 'Не удалось сохранить. Попробуйте позже.']);
        }

    }
}
