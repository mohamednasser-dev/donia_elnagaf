<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

           'image', 'name', 'barcode', 'quantity', 'alarm_quantity', 'price', 'total_cost', 'selling_price', 'gomla_price', 'category_id', 'user_id'
    ];
    public function Category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function employee()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function Bases()
    {
        return $this->belongsToMany(Base::class, 'product_bases', 'product_id', 'base_id');
    }
    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/products') . '/' . $img;
        else
            return asset('/uploads/products/default.jpg') ;
    }
}
