<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'password','address','phone','type','image','role_id','status','branch_number','deleted'
        ,'ident_image','fesh_image','specialist','total_payment'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/users_images') . '/' . $img;
        else
            return asset('/uploads/users_images/default_avatar.jpg') ;
    }
    public function getIdentImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/users_images/ident_images') . '/' . $img;
        else
            return "" ;
    }
    public function getFeshImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/users_images/fesh_images') . '/' . $img;
        else
            return "" ;
    }
}
