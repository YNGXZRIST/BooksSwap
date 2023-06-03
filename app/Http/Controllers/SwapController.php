<?php

namespace App\Http\Controllers;

use App\Actions\SwapCreateAction;
use App\Http\Requests\SwapCreateRequest;
use App\Models\GiveBooksModel;
use App\Models\Swap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwapController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $trades = Swap::query()->with('city')->where('status', Swap::STATUS_CREATED)->
        orderBy('id', 'Desc')->paginate(10);
        return view('pages.swap.index', compact('trades'));
    }

    public function addIndex(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $swapUpdate=null;
        if (isset($request->id)){
            $swapUpdate= Swap::where('id',$request->id)->where('user_id',Auth::user()->id)->first();

        }
        return view('pages.profile.swap.add',compact('swapUpdate'));
    }

    public function submit(SwapCreateRequest $request, SwapCreateAction $action): \Illuminate\Http\RedirectResponse
    {
        return $action->handle($request);

    }

    public function about($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $swap = Swap::query()->where(['id' => $id, 'status' => Swap::STATUS_CREATED])->with('city')
            ->firstOrFail();
        return view('pages.swap.about', compact('swap'));
    }
    public function remove(Request $request){

        Swap::where('id',$request->id)->update(['status'=>Swap::STATUS_DELETED]);
        return response()->json(['success' => true]);

    }
}
