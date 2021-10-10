<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerBill;
use App\Models\SupplierSale;
use App\Models\Outgoing;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public $today;

    public function __construct()
    {
        $this->middleware(['permission:income']);
        $mytime = Carbon::now();
        $this->today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }
    public function index()
    {
        $today = $this->today ;
        $customer_bills = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('date', $today)->paginate(20);
        $outgoings = Outgoing::where('branch_number' , Auth()->user()->branch_number)->where('date', $today)->paginate(20);
        $supplierPayments = SupplierSale::where('branch_number' , Auth()->user()->branch_number)->where('date', $today)->paginate(20);

        $total_pay = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('date',$today)->sum('pay');
        $total_outgoing = Outgoing::where('branch_number' , Auth()->user()->branch_number)->where('date',$today)->sum('cost');
        $total_supplierPayment = SupplierSale::where('branch_number' , Auth()->user()->branch_number)->where('date',$today)->sum('pay');
        $remain = $total_pay - ($total_outgoing + $total_supplierPayment);
        $selected_method = 'daily';
        $selected_month = Carbon::now()->month ;
        $selected_year = Carbon::now()->year ;

        return view('admin.income.income', compact('customer_bills' ,'outgoings','supplierPayments' ,'total_pay','total_outgoing','total_supplierPayment','remain','today','selected_method','selected_month','selected_year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function search(Request $request)
    {
        $today = $this->today ;
        $customer_bills = null ;
        $outgoings = null ;
        $supplierPayments = null ;
        $total_pay = null ;
        $total_outgoing = null ;
        $total_supplierPayment = null ;
        $remain = null ;
        $selected_method = null ;
        $selected_month = null;
        $selected_year = null ;

        if($request->selected_method == 'daily'){

            $customer_bills = CustomerBill::where('date', $request->date)->paginate(20);
            $outgoings = Outgoing::where('date', $request->date)->paginate(20);
            $supplierPayments = SupplierSale::where('date', $request->date)->paginate(20);

            $total_pay =CustomerBill::where('date',$request->date)->sum('pay');
            $total_outgoing =Outgoing::where('date',$request->date)->sum('cost');
            $total_supplierPayment =SupplierSale::where('date',$request->date)->sum('pay');
            $remain = $total_pay - ($total_outgoing + $total_supplierPayment);
            $today = $request->date ;
            $selected_method = 'daily';

            $selected_month = Carbon::now()->month ;
            $selected_year = Carbon::now()->year ;

        }else if($request->selected_method == 'monthly'){

            $customer_bills = CustomerBill::whereMonth('date', $request->month)->whereYear('date', $request->year)->paginate(20);
            $outgoings = Outgoing::whereMonth('date', $request->month)->whereYear('date', $request->year)->paginate(20);
            $supplierPayments = SupplierSale::whereMonth('date', $request->month)->whereYear('date', $request->year)->paginate(20);

            $total_pay =CustomerBill::whereMonth('date', $request->month)->whereYear('date', $request->year)->sum('pay');
            $total_outgoing =Outgoing::whereMonth('date', $request->month)->whereYear('date', $request->year)->sum('cost');
            $total_supplierPayment =SupplierSale::whereMonth('date', $request->month)
                                                    ->whereYear('date', $request->year)
                                                    ->sum('pay');
            $remain = $total_pay - ($total_outgoing + $total_supplierPayment);
            $today = '' ;
            $selected_method = 'monthly';

            $selected_month = $request->month ;
            $selected_year = $request->year ;

        }else if($request->selected_method == 'yearly'){

            $customer_bills = CustomerBill::whereYear('date', $request->year)->paginate(20);
            $outgoings = Outgoing::whereYear('date', $request->year)->paginate(20);
            $supplierPayments = SupplierSale::whereYear('date', $request->year)->paginate(20);

            $total_pay =CustomerBill::whereYear('date', $request->year)->sum('pay');
            $total_outgoing =Outgoing::whereYear('date', $request->year)->sum('cost');
            $total_supplierPayment =SupplierSale::whereYear('date', $request->year)
                                                    ->sum('pay');
            $remain = $total_pay - ($total_outgoing + $total_supplierPayment);
            $today = '' ;
            $selected_method = 'yearly';

            $selected_month = $request->month ;
            $selected_year = $request->year ;
        }
        return view('admin.income.income', compact('customer_bills' ,'outgoings','supplierPayments' ,'total_pay','total_outgoing','total_supplierPayment','remain','today','selected_method','selected_month','selected_year'));
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
    public function update(Request $request, $id)
    {
        //
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
