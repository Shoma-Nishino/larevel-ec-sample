<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StocksController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $stocks = Stock::all();
        $stocks = Stock::latest()->get();
        $stocks = Stock::paginate(2);

        if($request->has('keyword')) {
            // SQLのlike句でitemsテーブルを検索する
            $stocks = Stock::where('name', 'like', '%'.$request->get('keyword').'%')->paginate(2);
        }
        else{
            $stocks = Stock::paginate(2);
        }

        return view('stocks/index')->with('stocks', $stocks);
    }

    public function create(){
        return view('stocks/create');
    }

    public function store(Request $request){
        $stock = new Stock();
        $stock->name = $request->name;
        $stock->stockNum = $request->stockNum;
        $stock->price = $request->price;
        $stock->save();
        return redirect('/');
    }
}
