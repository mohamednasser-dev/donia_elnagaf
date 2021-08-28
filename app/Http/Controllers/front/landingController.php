<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inbox;

class landingController extends Controller
{
    public function index()
    {
        return view('front.home');
    } 

    public function show_login()
    {
        if(\Auth::guard('web')->check()){
            return redirect('/home');
        }else if(\Auth::guard('customer')->check()){
            return redirect('customer_home');
        }
        return view('front.login');
    }

    public function login(Request $request){

        if(\Auth::guard('web')->check()){
            return redirect('/home');
        }else if(\Auth::guard('customer')->check()){
            return redirect('customer_home');
        }

            // dd($request);
        $remeber=Request('Remember')==1? true:false ;
        if(auth::guard('customer')->attempt( ['email'=>Request('email'),'password'=>Request('password') ],$remeber) ){ 
            //Check if active user or not 
            if(Auth::user() != null){
                if(Auth::user()->status != 'active'){
                     \Auth::guard('customer')->logout();
                    session()->flash('danger', trans('admin.not_auth')); 
                    return redirect('/customer_login');
                }else{
                    return redirect('/customer_home');
                }
            }else{
                session()->flash('danger',trans('admin.invaldemailorpassword'));
                return redirect('/customer_login');
            }

        }else{
            session()->flash('danger',trans('admin.invaldemailorpassword'));
            return redirect('/customer_login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('id','name','image','category_id')->get();
        return view('front.products',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
            return view('front.contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'user_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'message' => 'required',
            ]);
        Inbox::create($data);
        return redirect(url('/'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
