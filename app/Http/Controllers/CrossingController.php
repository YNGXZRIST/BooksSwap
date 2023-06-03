<?php

namespace App\Http\Controllers;

use App\Actions\CrossingCreateAction;
use App\Http\Requests\CrossingCreateRequest;
use App\Models\CrossingModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrossingController extends Controller
{
    public function index(): Factory|View|Application
    {
        $crossing = CrossingModel::query()->with(['crossings','city'])->orderBy('updated_at', 'desc')->paginate(10);

        return view('pages.crossing.index', compact('crossing'));

    }
    public function about($id): Factory|View|Application
    {
        $crossing=CrossingModel::query()->with(['crossings','city'])->where('id',$id)->first();
        return view('pages.crossing.about',compact('crossing'));
    }

    public function addIndex(): Factory|View|Application
    {
        return view('pages.profile.crossing.add');
    }

    public function submit(CrossingCreateRequest $request, CrossingCreateAction $action)
    {
        return $action->handle($request);

    }
}
