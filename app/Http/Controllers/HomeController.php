<?php
namespace App\Http\Controllers;

use App\Models\CustomerBill;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Base;
use App\Models\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bases = Base::all()->count();
        $products = Product::all()->count();
        $bills = CustomerBill::where('is_bill','y')->count();
        $suppliers = Supplier::all()->count();
        $customers = Customer::all()->count();
        $emps = User::where('type','user')->count();
        return view('home',compact('bases','products','bills','suppliers','customers','emps'));
    }
}
