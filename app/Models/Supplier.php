<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','phone','address','status' ,'user_id'
    ];
    
    public function employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function SupplierSale()
    {
        return $this->hasMany('App\Models\SupplierSale','supplier_id','id');
    }
}
