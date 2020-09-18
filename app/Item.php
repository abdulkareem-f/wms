<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'manufacturer', 'quantity', 'expiry_date',
    ];

    public function units(){
        return $this->hasMany('App\ItemUnits', 'item_id', 'id');
    }
}
