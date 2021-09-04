<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_history extends Model
{
    protected $fillable = [
        'quantity','gomla_price','selling_price','type','category_id','product_id','user_id'
    ];

}
