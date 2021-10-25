<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_history;
use Illuminate\Http\Request;
use App\Models\CustomerBill;
use App\Models\BillProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class buyBillsController extends Controller
{
    public $today;

    public function __construct()
    {
        $this->middleware(['permission:bills']);
        $mytime = Carbon::now();
        $this->today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }

    public function index()
    {
        $customer_bills = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('date', Carbon::now()->toDateString())->get();
        return view('admin.buy_bills.buy_bills', compact('customer_bills'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print_bill($bill_id)
    {
        $today = $this->today;
        $CustomerBill = CustomerBill::find($bill_id);
        $BillProduct = BillProduct::where('bill_id', $bill_id)->get();
        return view('admin.buy.bill_design', compact('today', 'CustomerBill', 'BillProduct'));
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
            $customer_bills = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('bill_num', $request->bill_num)->get();
        } elseif ($request->date != null) {
            $customer_bills = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('date', $request->date)->get();
        } else {
            $customer_bills = CustomerBill::where('branch_number' , Auth()->user()->branch_number)->where('cust_id', $request->cust_id)->get();
        }
        return view('admin.buy_bills.buy_bills', compact('customer_bills'));
    }

    public function edit_product(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric|between:0,9999.9',
        ]);
        if ($validation->fails()) {
            Alert::error('خطأ',  $validation->messages()->getMessages());
            return back();
        } else {
            $bill_product = BillProduct::where('id', $request->product_id)->first();

            if ($request->quantity > $bill_product->quantity) {
                $new_quantity = $bill_product->quantity - $request->quantity;
                $store_product = Product::where('id', $bill_product->product_id)->first();
                if ($store_product->quantity >= $new_quantity) {
                    $bill_product->price = $request->price;
                    $bill_product->quantity = $request->quantity;
                    $bill_product->total = $request->get('quantity') * $request->get('price');;
                    if ($bill_product->save()) {
                        $store_product->quantity = $store_product->quantity - $new_quantity;
                        $store_product->save();

                        $history_data['product_name'] = $store_product->name;
                        $history_data['notes'] = 'تعديل على المنتج';
                        $history_data['quantity'] = $new_quantity;
                        $history_data['gomla_price'] = $store_product->gomla_price;
                        $history_data['selling_price'] = $store_product->selling_price;
                        $history_data['product_id'] = $bill_product->product_id;
                        $history_data['category_id'] = $store_product->category_id;
                        $history_data['type'] = 'remove';
                        $history_data['user_id'] = Auth::user()->id;
                        Product_history::create($history_data);
                    }
                } else {
                    Alert::error('خطأ',  'لا يوجد عدد كافي بالمخزن');
                    return back();
                }
            }elseif($request->quantity < $bill_product->quantity){
                $new_quantity = $bill_product->quantity - $request->quantity;
                $store_product = Product::where('id', $bill_product->product_id)->first();
                $bill_product->price = $request->price;
                $bill_product->quantity = $request->quantity;
                $bill_product->total = $request->get('quantity') * $request->get('price');;
                if ($bill_product->save()) {
                    $store_product->quantity = $store_product->quantity + $new_quantity;
                    $store_product->save();

                    $history_data['product_name'] = $store_product->name;
                    $history_data['notes'] = 'تعديل على المنتج';
                    $history_data['quantity'] = $new_quantity;
                    $history_data['gomla_price'] = $store_product->gomla_price;
                    $history_data['selling_price'] = $store_product->selling_price;
                    $history_data['product_id'] = $bill_product->product_id;
                    $history_data['category_id'] = $store_product->category_id;
                    $history_data['type'] = 'add';
                    $history_data['user_id'] = Auth::user()->id;
                    Product_history::create($history_data);
                }
            }elseif ($request->quantity == $bill_product->quantity){
                $bill_product->price = $request->price;
                $bill_product->quantity = $request->quantity;
                $bill_product->total = $request->get('quantity') * $request->get('price');;
                $bill_product->save();
            }
            //commit changes to main bill ...

            $total_all_bill = BillProduct::where('bill_id',$bill_product->bill_id)->get()->sum('total');

            $cust_bill = CustomerBill::find($bill_product->bill_id);

            $cust_bill->total = $total_all_bill ;
            $cust_bill->remain = $total_all_bill - $cust_bill->pay;
            $cust_bill->save();
            Alert::success('تم',  'تم التعديل بنجاح');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill_product = BillProduct::where('bill_id', $id)->get();
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
