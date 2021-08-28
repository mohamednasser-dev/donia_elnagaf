<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerBill;
use App\Models\BillProduct;
use Carbon\Carbon;

class buyBillsController extends Controller
{
    public $today ;
    public function __construct()
    {
        $this->middleware(['permission:bills']);
        $mytime = Carbon::now();
        $this->today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }
    public function index()
    {
        $customer_bills = CustomerBill::where('date', Carbon::now()->toDateString())->get();
        return view('admin.buy_bills.buy_bills', compact('customer_bills'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print_bill( $bill_id){
        $today = $this->today;
        $CustomerBill = CustomerBill::find($bill_id);
        $BillProduct =  BillProduct::where('bill_id',$bill_id)->get();
        return view('admin.buy.bill_design',compact('today','CustomerBill','BillProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->bill_num != null) {
            $customer_bills = CustomerBill::where('bill_num', $request->bill_num)->get();

        } elseif ($request->date != null) {
            $customer_bills = CustomerBill::where('date', $request->date)->get();
        } else {
            $customer_bills = CustomerBill::where('cust_id', $request->cust_id)->get();

        }
        return view('admin.buy_bills.buy_bills', compact('customer_bills'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill_product  = BillProduct::where('bill_id', $id)->get();
        return view('admin.buy_bills.bill_product', compact('bill_product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
