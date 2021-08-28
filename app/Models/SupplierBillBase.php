<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierBillBase extends Model
{
    protected $fillable = [
        'name','quantity','purchas_price','total','date','supplier_sale_id','supplier_id','base_id','user_id'
    ];
}
