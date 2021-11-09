<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomerBill extends Model
{
    protected $guarded = [];

    public function Employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function Customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'cust_id');
    }


    public function Saler_man()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
