<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierSale extends Model
{
    protected $fillable = [
        'supplier_id','bill_num','total','pay','remain','date','user_id','notes','is_bill'
    ];

    public function Employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function Supplier()
    {
        return $this->hasOne('App\Models\Supplier', 'id', 'supplier_id');
    }
}
