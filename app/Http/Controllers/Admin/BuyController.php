<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product_history;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;
use App\Models\CustomerBill;
use App\Models\BillProduct;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Exception;
use DB;

class BuyController extends Controller
{
    public $today;

    public function __construct()
    {
        //to get today date
        $mytime = Carbon::now();
        $this->today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }

    public function index()
    {
    }

    public function show($type)
    {
        $user = auth()->user();
        $today = $this->today;
        $products = Product::pluck('id', 'name');
        $products = json_encode($products);
        $customers = Customer::all();
        $customer_bills = CustomerBill::where('type', $type)->where('branch_number', $user->branch_number)->where('is_bill', 'y')->get();
        $bill_num = null;
        $customer_bills_selected = null;
        $customer_bills_products = null;
        if (count($customer_bills) == 0) {
            $bill_num = 1;
        } else {
            $customer_bills_selected = CustomerBill::where('branch_number', $user->branch_number)->where('type', $type)->where('is_bill', 'y')->orderBy('created_at', 'desc')->latest('bill_num')->first();
            if ($customer_bills_selected) {
                $bill_num = $customer_bills_selected->bill_num;
            } else {
                $bill_num = 1;
            }
            $customer_bills_products = BillProduct::where('bill_id', $customer_bills_selected->id)->orderBy('id', 'desc')->paginate(15);
        }

        $emps = User::where('branch_number', $user->branch_number)->get()->pluck('name', 'id');
        return view('admin.buy.buy', compact('emps', 'bill_num', 'customer_bills_selected',
            'customers', 'products', 'customer_bills_products', 'today', 'type'));
    }

    public function store_cust_bill(Request $request)
    {
        $last_bill = CustomerBill::where('branch_number', Auth::user()->branch_number)
            ->orderBy('created_at', 'desc')->first();
        if ($last_bill) {
            if ($last_bill->emp_id == null) {
                Alert::warning('تنبية', 'يجب حفظ اخر فاتوره اولا');
                return back();
            }
        }
        $data = $this->validate(\request(),
            [
                'type' => 'required',
                'bill_num' => 'required',
                'cust_id' => 'required|exists:customers,id'
            ]);
        $customer_bills = CustomerBill::all();
        if (count($customer_bills) == 0) {
            $data_create['bill_num'] = 1;
        } else {
            $data_create['bill_num'] = $request->bill_num + 1;
        }
        $data_create['cust_id'] = $request->cust_id;
        $data_create['date'] = $this->today;
        $data_create['type'] = $request->type;
        $data_create['is_bill'] = 'y';
        $data_create['user_id'] = Auth::user()->id;
        $data_create['branch_number'] = Auth::user()->branch_number;
        CustomerBill::create($data_create);
        Alert::success('تم', trans('admin.fatora_open_success'));
        return back();
    }

    function get_bill_product_data($bill_id)
    {
        $bill_products = BillProduct::select('name', 'barcode', 'quantity', 'price', 'total')->where('bill_id', $bill_id)->get();
        return Datatables::of($bill_products)->make(true);
    }

    public function search_customer(Request $request)
    {
//        $data = Customer::select("id", "name")->get();
        if ($request->has('q')) {
            $search = $request->q;
            $data = Customer
                ::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function bill_design(Request $request, $bill_id)
    {
        $user = auth()->user();
        $today = $this->today;
        $selected_bill = CustomerBill::find($bill_id);
        if ($request->reservation) {
            if ($request->reservation == 'on') {
                $data['reservation'] = '1';
                $data['first_pay'] = $request->pay;
            }
        }
        if ($request->khasm) {
            $data['khasm'] = $request->khasm;
        } else {
            $data['khasm'] = 0;
        }

        $data['pay'] = $request->pay;
        $data['remain'] = $request->remain;
        $data['emp_id'] = $request->emp_id;
        $data['branch_number'] = $user->branch_number;
        CustomerBill::where('id', $bill_id)->update($data);
        if ($selected_bill->type != 'back') {
            if ($selected_bill->emp_id == null) {
                //add total payment to emp
                $emp_data = User::find($request->emp_id);
                $emp_data->total_payment = $emp_data->total_payment + $request->pay;
                $emp_data->save();
            }
        }

        //prepare data to print design paper ...
        $CustomerBill = CustomerBill::find($bill_id);
        $BillProduct = BillProduct::where('bill_id', $bill_id)->get();
        return view('admin.buy.new_invoice', compact('today', 'CustomerBill', 'BillProduct'));
    }

    public function bill_design_last($bill_id)
    {
        $today = $this->today;
        $CustomerBill = CustomerBill::find($bill_id);
        $BillProduct = BillProduct::where('bill_id', $bill_id)->get();
//        return view('admin.buy.last_bill',compact('today','CustomerBill','BillProduct'));
        return view('admin.buy.invoice', compact('today', 'CustomerBill', 'BillProduct'));
    }

    public function live_search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $type = $request->get('type');

            if ($query != null) {
                $data = Product::with('Category')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('barcode', 'like', '%' . $query . '%')
                    ->orderBy('name', 'desc')->where('deleted', '0')
                    ->get();
            } else {
                $data = null;
            }
            if ($data == null) {
                $total_row = 0;
            } else {
                $total_row = $data->count();
            }

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $totalPrice = null;
                    $output .= '
                    <tr>
                        <td class = "center" >' . $row->name . '</td>
                        <td class = "center" >' . $row->barcode . '</td>
                        <td class = "center" >' . $row->quantity . '</td>
                        <td class = "center" >' . $row->Category->name . '</td>
                        <td class = "center" >' . $row->selling_price . '</td>
                        <td class = "center" >
                            <a class="btn btn-success btn-circle" data-product-id="' . $row->id . '"  data-price="' . $row->selling_price . '" data-quantity="' . $row->quantity . '" id="sale_btn" alt="default" data-toggle="modal" data-target="#sale-modal" >
                                <i class="fa fa-shopping-cart" ></i>
                            </a>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="5">' . trans('admin.no_data_found') . '</td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'product_id' => 'required',
            'bill_id' => 'required',
            'quantity' => 'required',
            'price' => 'required|numeric|between:0,9999.9',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            Alert::error('خطأ', $validation->messages()->getMessages());
            return back();
        } else {
            $exist_bill = CustomerBill::find($request->get('bill_id'));
            if ($exist_bill->emp_id != null) {
                Alert::error('خطأ', 'لا تستطيع اضافة منتج جديد في فاتوره تم حفظها');
                return back();
            }
            if ($request->get('button_action') == "insert") {
                $total = $request->get('quantity') * $request->get('price');
                $product = Product::find($request->get('product_id'));
                $bill_Product = new BillProduct([
                    'name' => $product->name,
                    'product_id' => $request->get('product_id'),
                    'bill_id' => $request->get('bill_id'),
                    'quantity' => $request->get('quantity'),
                    'price' => $request->get('price'),
                    'user_id' => Auth::user()->id,
                    'total' => $total
                ]);
                if ($bill_Product->save()) {
                    if ($request->type == 'back') {
                        $product->quantity = $product->quantity + $request->get('quantity');
                    } else {
                        $product->quantity = $product->quantity - $request->get('quantity');
                    }
                    if ($product->save()) {
                        $cust_bill = CustomerBill::find($request->get('bill_id'));
                        $cust_bill->total = $cust_bill->total + $total;
                        $cust_bill->remain = $cust_bill->remain + $total;
                        $cust_bill->save();

                        // add product to history
                        $history_data['billProduct_id'] = $bill_Product->id;
                        $history_data['product_name'] = $product->name;
                        if ($request->type == 'back') {
                            $history_data['notes'] = 'منتج مرتجع';
                            $history_data['type'] = 'add';
                        } else {
                            $history_data['notes'] = 'بيع المنتج';
                            $history_data['type'] = 'remove';
                        }
                        $history_data['quantity'] = $request->get('quantity');
                        $history_data['gomla_price'] = $product->gomla_price;
                        $history_data['selling_price'] = $request->get('price');
                        $history_data['product_id'] = $request->get('product_id');
                        $history_data['category_id'] = $product->category_id;
                        $history_data['user_id'] = Auth::user()->id;
                        Product_history::create($history_data);
                        Alert::success('تم', trans('admin.added_bill_product'));
                        return back();
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param int $id
     * @return \Illuminate\Http\Response
     * /**
     * Show the form for editing the specified resource.
     *
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
    public function select_products(Request $request)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $BillProduct = BillProduct::where('id', $id)->first();
        try {
            Product_history::where('billProduct_id', $id)->delete();
            if ($BillProduct->delete()) {
                //reEnter Product back quantity ..
                $product = Product::find($BillProduct->product_id);
                if ($request->type == 'back') {
                    $product->quantity = $product->quantity - $BillProduct->quantity;
                } else {
                    $product->quantity = $product->quantity + $BillProduct->quantity;
                }
                if ($product->save()) {
                    //update Bill total
                    $cust_bill = CustomerBill::find($BillProduct->bill_id);
                    $cust_bill->total = $cust_bill->total - $BillProduct->total;
                    $cust_bill->remain = $cust_bill->remain - $BillProduct->total;
                    $cust_bill->save();
                    Alert::success('تم', trans('admin.deleteSuccess'));
                }
            }
        } catch (Exception $exception) {
            Alert::error('تم', trans('admin.error'));
        }
        return back();
    }

    public function destroy_all(Request $request, $bill_id)
    {
        $BillProducts = BillProduct::where('bill_id', $bill_id)->get();
        foreach ($BillProducts as $product) {
            Product_history::where('billProduct_id', $product->id)->delete();
            $pro = BillProduct::where('id', $product->id)->first();
            if ($pro->delete()) {
                //reEnter Product back quantity ..
                $edit_product = Product::find($product->product_id);
                if ($request->type == 'back') {
                    $edit_product->quantity = $edit_product->quantity - $product->quantity;
                } else {
                    $edit_product->quantity = $edit_product->quantity + $product->quantity;
                }
                $edit_product->save();
            }
        }
        $bill = CustomerBill::find($bill_id);
        $bill->total = 0;
        $bill->remain = 0 - $bill->pay;
        $bill->save();
        Alert::success('تم', trans('admin.deleteAllSuccess'));
        return back();
    }
}
