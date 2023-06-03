<?php

namespace App\Http\Controllers;

use App\Models\GiveBooksModel;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $cartItems = \Cart::getContent();

        return view('pages.like.index', compact('cartItems'));
    }


    public function add(Request $request)
    {
//        dd($request->id);
        $book = GiveBooksModel::where('id', $request->id)->first();
        \Cart::add([
            'id' => $book->id,
            'author' => $book->author,
            'name' => $book->title,
            'address'=>$book->address,
            'description'=>$book->description,
            'condition'=>$book->condition,
            'price'=>$book->price,
            'quantity'=>1
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return response()->json(['success' => true]);
//        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return response()->json(['success' => true]);
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

}
