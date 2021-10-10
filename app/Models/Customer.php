<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'phone','address', 'status' ,'user_id','branch_number'

    ];

    public function employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function CustomerBills()
    {
        return $this->hasMany('App\Models\CustomerBill','cust_id','id');
    }
}
