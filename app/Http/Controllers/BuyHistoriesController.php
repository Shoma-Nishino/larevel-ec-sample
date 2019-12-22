<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\BuyHistory;
use Auth;

class BuyHistoriesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $stocks = BuyHistory::select('cartStockNum', 'stocks.name', 'stocks.price')
        ->where('user_id', '=', Auth::id())
        ->join('stocks', 'stocks.id', '=', 'buy_histories.stock_id')
        ->get();
        return view('buy/index')->with('stocks', $stocks);
    }
}
