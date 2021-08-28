<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $fillable = [
        'name','quantity','alarm_quantity','price','purchas_price','barcode','measur_unit','category_id','user_id'
    ];

    public function Category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_bases', 'base_id', 'product_id');
    }
}
