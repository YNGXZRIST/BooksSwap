<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\GenreModel;
use App\Models\GiveBooksGenre;
use App\Models\GiveBooksImages;
use App\Models\GiveBooksModel;
use App\Models\ThemeBooksModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class GiveBooksController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {

        $genreId=null;
        $books=[];
        if  (isset($request->genre) ) {
            $genreId = $request->genre;
            $books = GiveBooksModel::query()->whereHas('giveBooks_genre', function ($query) use ($genreId) {
                $query->where('genre_id', $genreId);
            })->pluck('id');
        }

        $giveBooksQuery = GiveBooksModel::query()->with(['giveBooks_genre'=>function ($query){
            $query->join('genre', 'genre.id', 'genre_id');
        }])->with(['images', 'mainImage']);
            if (!empty($books)>0){
                $giveBooksQuery->whereIn('id',$books);
            }
     $giveBooks= $giveBooksQuery->orderBy('id', 'Desc')->paginate(10)->withQueryString();
        return view('pages.giveBooks.index', compact('giveBooks'));
    }

    public function aboutBook(int $id): Factory|View|Application
    {
        $book = GiveBooksModel::query()->with(['giveBooks_genre' => function ($query) {
            $query->join('genre', 'genre.id', 'genre_id');
        }, 'images', 'giveBooks_genre', 'user', 'city'])->where('id', $id)->firstOrFail();

        return view('pages.giveBooks.aboutBook', compact('book'));
    }

    public
    function add(Request $request): Factory|View|Application
    {
        $giveBookUpdate=null;
        if (isset($request->id)){
           $giveBookUpdate= GiveBooksModel::where('id',$request->id)->where('user_id',Auth::user()->id)->first();

        }
        return view('pages.profile.addGiveBooks',compact('giveBookUpdate'));
    }

    public
    function submit(Request $request)
    {
        $validated = $request->validate(['bookName' => 'required|string|max:255',
            'bookAuthor' => 'required|string|max:255',
            'bookGenre' => 'required|string|max:255', 'humanAddress' => 'required']);

        $user = $request->user();



        $giveBook =isset($request->updateId)? GiveBooksModel::where(['id'=>$request->updateId])->first(): new GiveBooksModel();
        if (isset($request->updateId)){
            $city=Cities::where('id',$giveBook->city_id)->first();
        }else{
            $city = Cities::firstOrCreate(['name' => $request->city]);
        }
        $giveBook->author = $validated['bookAuthor'];
        $giveBook->title = $validated['bookName'];

        $giveBook->address = $validated['humanAddress'];
        $giveBook->description = $request->bookComments;
        $giveBook->coordinates = $request->coordinates;
        $giveBook->city_id = $city->id;
        $giveBook->user_id = $user->id;
        $giveBook->condition = $request->bookCondition;

        if (!isset($request->price)) {
            $price = 0;
        } else {
            $price = $request->price;
        }
        $giveBook->price = $price;
        $giveBook->save();
        if (!isset($request->bookSubgenre)) {
            $bookGenre = new GiveBooksGenre();
            $bookGenre->book_id = $giveBook->id;
            $bookGenre->genre_id = 110;
            $bookGenre->save();
        } else {
            foreach ($request->bookSubgenre as $item) {
                $bookGenre = new GiveBooksGenre();
                $bookGenre->book_id = $giveBook->id;
                $bookGenre->genre_id = $item;
                $bookGenre->save();

            }
        }


        foreach ($request->file('images') ?? [] as $imagefile) {

            $image = new GiveBooksImages();
            $path = $imagefile->store('/images/giveBooks', ['disk' => 'my_files']);
            $image->url = $path;
            $image->give_book_id = $giveBook->id;
            $image->save();
        }


        return redirect(route('profile.index'));
    }

    public
    function getSubGenreByGenre(Request $request): array
    {
        return GenreModel::query()->select('id', 'genre_name')->where('theme_id', $request->all()['genre'])->get()->toArray();
    }
    public function remove(Request $request){

        GiveBooksModel::where('id',$request->id)->delete();
        return response()->json(['success' => true]);

    }
}
