<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{
    //
    protected $fillable = ['name', 'stockNum', 'price'];

    public function carts()
    {
      return $this->hasMany('App\Cart');
    }

    public function buy_histories()
    {
      return $this->hasMany('App\BuyHistory');
    }
}
