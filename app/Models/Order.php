<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'car_type','car_model','in_color','out_color','double_thread_color',
        'design_type','recieved_date','special_request','chaire_image',
        'sofa_image','bill_type','cust_id','status'
    ];

    public function Customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'cust_id');
    }


}
