<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login_history extends Model
{
    protected $fillable = [
        'type','user_id'
    ];

    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
