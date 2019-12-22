<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = ['user_id', 'stock_id', 'cartStockNum'];

    Public function user()
    {
      return $this->belongsTo('App\User');
    }

    Public function stock()
    {
      return $this->belongsTo('App\Stock');
    }
}
