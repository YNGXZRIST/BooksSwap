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
use Illuminate\Support\Facades\Storage;


class GiveBooksController extends Controller
{
    public function index(): Factory|View|Application
    {
        $giveBooks = GiveBooksModel::with(['giveBooks_genre' => function ($query) {
            $query->join('genre', 'genre.id', 'genre_id');
        }])->with(['images','mainImage'])->orderBy('id', 'Desc')->paginate(10);
        return view('pages.giveBooks.index', compact('giveBooks'));
    }

    public function add(): Factory|View|Application
    {
        return view('pages.profile.addGiveBooks');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate(['bookName' => 'required|string|max:255',
            'bookAuthor' => 'required|string|max:255',
            'bookGenre' => 'required|string|max:255', 'humanAddress' => 'required']);

        $user = $request->user();
        $city = Cities::firstOrCreate(['name' => $request->city]);
        $giveBook = new GiveBooksModel();
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


    foreach ($request->file('images')??[] as $imagefile) {

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
}
