<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBase extends Model
{
    protected $fillable = [
        'base_id','product_id','quantity',
        ];

    public function base()
    {
        return $this->belongsTo(Base::class, 'base_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
