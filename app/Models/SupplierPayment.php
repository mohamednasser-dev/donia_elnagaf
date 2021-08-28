<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = [
        'money','notes','bill_id','supplier_id','user_id'
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

