<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemUnits extends Model
{
    protected $fillable = [
        'name', 'buy_price', 'sell_price',
    ];
}
