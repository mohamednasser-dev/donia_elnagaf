<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_history extends Model
{
    protected $guarded = [];
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
