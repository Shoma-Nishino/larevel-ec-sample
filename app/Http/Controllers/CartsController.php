<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Cart;
use App\Stock;
use App\BuyHistory;
use App\Mail\Buy;
use Auth;

class CartsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $stocks = Cart::select('cartStockNum', 'stocks.name', 'stocks.price')
        ->where('user_id', '=', Auth::id())
        ->join('stocks', 'stocks.id', '=', 'carts.stock_id')
        ->get();
        return view('carts/index')->with('stocks', $stocks);
    }

    public function store(Request $request){
        $cart = new Cart();
        $cart->user_id = $request->user_id;
        $cart->stock_id = $request->stock_id;
        $cart->cartStockNum = $request->cartStockNum;
        $cart->save();
        return redirect('/');
    }

    public function buy(Request $request){
        // $stocks = Cart::select('user_id', 'stock_id', 'cartStockNum')
        // ->where('user_id', '=', Auth::id())
        // ->join('stocks', 'stocks.id', '=', 'carts.stock_id')
        // ->get()
        // ->toArray();
        // BuyHistory::insert($stocks);

        

        $cartStocks = Cart::select('user_id', 'stock_id', 'cartStockNum')
        ->where('user_id', '=', Auth::id())
        ->join('stocks', 'stocks.id', '=', 'carts.stock_id')
        ->get();
        foreach($cartStocks as $cartStock){
            $buy = new BuyHistory();
            $stock = Stock::find($cartStock->stock_id);

            $stock->stockNum = $stock->stockNum - $cartStock->cartStockNum;
            $stock->save();

            $buy->user_id = $cartStock->user_id;
            $buy->stock_id = $cartStock->stock_id;
            $buy->cartStockNum = $cartStock->cartStockNum;
            $buy->save();
        }

        $stocks = Cart::select('cartStockNum', 'stocks.name', 'stocks.price')
        ->where('user_id', '=', Auth::id())
        ->join('stocks', 'stocks.id', '=', 'carts.stock_id')
        ->get();
        Mail::to(Auth::user()->email)->send(new Buy($stocks));

        $stocksDelete = Cart::where('user_id', '=', Auth::id())->delete();
        return redirect('/');
    }
}
