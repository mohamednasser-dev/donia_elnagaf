<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = [
        'money', 'notes' , 'bill_id' , 'cust_id' ,'user_id'
    ];

    public function Employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function Customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'cust_id');
    }
}
