<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierBillBase;
use App\Models\SupplierSale;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Base;
use Carbon\Carbon;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class baseBillsController extends Controller
{
    public $today ;
    public function __construct()
    {
        $this->middleware(['permission:add base bill']);
        //to get today date
        $mytime = Carbon::now();
        $this->today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }

    public function index(){
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);

        $suppliers = Supplier::all();
        $supplier_sales = SupplierSale::all();

        if(count($supplier_sales) == 0){
            $bill_num = 1 ;
            $supplier_sales_selected = null;
            $supplier_bill_bases = null;
//            dd($supplier_bill_bases);
            return view('admin.base_bills.base_bills',compact('bill_num','supplier_sales_selected','suppliers','supplier_bill_bases','bases'));
        }else{
            $supplier_sales_selected = SupplierSale::where('is_bill','y')->latest('bill_num')->first();
            $bill_num = $supplier_sales_selected->bill_num ;
            $supplier_bill_bases = SupplierBillBase::where('supplier_sale_id',$supplier_sales_selected->id)->paginate(20);
            return view('admin.base_bills.base_bills',compact('bill_num','supplier_sales_selected','suppliers','bases','supplier_bill_bases'));
        }
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
    public function store(Request $request){
        $data = $this->validate(\request(),
            [
                'bill_num' => 'required',
                'supplier_id' => 'required|exists:suppliers,id'
            ]);
        $supplier_sales = SupplierSale::all();
        if(count($supplier_sales) == 0){
            $data['bill_num'] = 1;
        }else{
            $data['bill_num'] = $request->bill_num + 1;
        }
        $data['date'] = $this->today;
        $data['is_bill'] = 'y';
        $data['user_id'] = Auth::user()->id;
        SupplierSale::create($data);
        Alert::success('تم', trans('admin.fatora_open_success'));
        return redirect(url('base_bills'));
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

    public function dataAjax(Request $request){
        $data = Supplier::select("id", "name")->get();

        if ($request->has('q')) {
            $search = $request->q;
            $data = Supplier
                ::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
    public function dataAjax_base(Request $request){
        $data = Base::select("id", "name")->get();

        if ($request->has('q')) {
            $search = $request->q;
            $data = Base
                ::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function store_base_bill(Request $request){
        $data = $this->validate(\request(),
            [
                'supplier_id' => 'required|exists:suppliers,id',
                'supplier_sale_id' => 'required|exists:supplier_sales,id',
                // for pivot
                'quantity*' => 'required',
                'base_id*' => 'required',
                'purchas_price*' => 'required',
            ]);
        foreach ($request->rows as $row) {
            if ($row['base_id'] != null && $row['quantity'] != null && $row['purchas_price'] != null) {
                $row['user_id'] = Auth::user()->id;
                $row['supplier_id'] = $data['supplier_id'];
                $row['supplier_sale_id'] = $data['supplier_sale_id'];
                $base = Base::find($row['base_id']);
                $row['name'] = $base->name;
                $row['date'] = $this->today ;
                $row['total'] =  $row['quantity'] * $row['purchas_price'] ;
                $player = SupplierBillBase::create($row);

                //To increase base quantity by new quantity from supplier
                $base->quantity = $base->quantity + $row['quantity'];
                $base->save();
            }
        }
        $total = SupplierBillBase::where('supplier_sale_id',$data['supplier_sale_id'])->sum('total');
        $update_total['total'] = $total ;
        $update_total['remain'] = $total ;
        SupplierSale::where('id',$data['supplier_sale_id'])->update($update_total);
        Alert::success('تم', trans('admin.addedsuccess'));
        return back();

    }
    public function destroy_bill_base($id){
        $supplierBillBase = SupplierBillBase::where('id', $id)->first();
        try {
            //To decrease base quantity after delete product from supplier bill
            $base = Base::find($supplierBillBase->base_id);
            $base->quantity = $base->quantity - $supplierBillBase->quantity;
            $base->save();

            $supplierBillBase->delete();



            $total = SupplierBillBase::where('supplier_sale_id',$supplierBillBase->supplier_sale_id)->sum('total');
            $update_total['total'] = $total ;
            $update_total['remain'] = $total ;
            SupplierSale::where('id',$supplierBillBase->supplier_sale_id)->update($update_total);
            Alert::success('تم', trans('admin.deleteSuccess'));
        }catch(Exception $exception){
            Alert::error('خطأ', trans('admin.deleteError'));
        }
        return back();
    }
}
