<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierBillBase;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use App\Models\CustomerBill;
use App\Models\BillProduct;
use App\Models\Outgoing;
use App\Models\Product;
use App\Models\Base;

class CloseYearController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Lock a fiscal year']);
    }
    public function index()
    {
        //This to Outgoing part
        $outgoing = Outgoing::all()->sum('cost');
        $supplier_payment = SupplierPayment::all()->sum('money');
        $total_outGoings = $outgoing + $supplier_payment ;

        //This for buy part
        $total_bills_cost = CustomerBill::all()->sum('total');
        $total_payed = CustomerBill::all()->sum('pay');
        $total_remain = $total_bills_cost - $total_payed ;

        //This for Basies
        $base_now_quantity = Base::all()->sum('quantity');
        $base_out_quantity = SupplierBillBase::all()->sum('quantity');
        $total_bases = $base_now_quantity + $base_out_quantity ;

         //This for products
        $products_now_quantity = Product::all()->sum('quantity');
        $products_out_quantity = BillProduct::all()->sum('quantity');
        $total_products = $base_now_quantity + $base_out_quantity ;
        // compact('categories')
        $data['outgoing'] = $outgoing ;
        $data['supplier_payment'] = $supplier_payment ;
        $data['total_outGoings'] = $total_outGoings ;

        $data['total_bills_cost'] = $total_bills_cost ;
        $data['total_payed'] = $total_payed ;
        $data['total_remain'] = $total_remain ;

        $data['base_now_quantity'] = $base_now_quantity ;
        $data['base_out_quantity'] = $base_out_quantity ;
        $data['total_bases'] = $total_bases ;

        $data['products_now_quantity'] = $products_now_quantity ;
        $data['products_out_quantity'] = $products_out_quantity ;
        $data['total_products'] = $total_products ;

        return view('admin.close_year.close_year', compact('data'));
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
