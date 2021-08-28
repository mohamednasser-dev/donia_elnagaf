<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    protected $fillable = [
        'product_id','bill_id','name','quantity','price','total','date','user_id'
    ];

    public function Product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function Employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
