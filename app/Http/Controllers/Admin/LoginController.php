<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Login_history;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login(){
        $remeber=Request('Remember')==1? true:false ;
        if(auth::guard('web')->attempt( ['email'=>Request('email'),'password'=>Request('password') ],$remeber) ){
            //Check if active user or not
            if(Auth::user()->status != 'active'){
                Auth::logout();
                return redirect('login')->with('danger',trans('admin.not_auth'));
            }else{
                Login_history::create(['user_id'=>Auth::user()->id]);
                if(Auth::user()->type == 'admin'){
                    return redirect('/home');
                }else{
                    $setting = Setting::find(1);
                    $mytime = Carbon::now();
                    $today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
                    $today_date_only =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
                    //get start date of active selected gwla ...
                    $open_time =  $setting->open_time;
                    $close_time =  $setting->close_time;
                    $open_date = $today_date_only.' '.$open_time ;
                    $close_date = $today_date_only.' '.$close_time ;
                    $final_Start = date("Y-m-d H:i", strtotime($open_date));
                    $final_Start = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
                    $final_close = date("Y-m-d H:i", strtotime($close_date));
                    $final_close = Carbon::createFromFormat('Y-m-d H:i', $final_close);
                    //make if statement to avoid user to change his squad formation during active gwla ...
                    if(($today >= $final_Start && $today <= $final_close)){
                        return redirect('/home');
                    }else{
                        Auth::logout();
                        return redirect('login')->with('danger', 'لا يمكن تسجيل الدخول الان .... الوقت الان خارج مواعيد العمل');
                    }
                }
            }
        }else{
          return redirect('login')->with('danger',trans('admin.invaldemailorpassword'));;
        }
    }
    public function logout(){
        Login_history::create([ 'user_id'=>Auth::user()->id ,'type'=>'logout' ]);
        Auth::logout();
        return redirect('login');
    }
}
