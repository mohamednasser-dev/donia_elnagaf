<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierPayment;
use App\Models\SupplierSale;
use App\Models\SupplierBillBase;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class supllierController extends Controller
{
    public $today ;
    public function __construct()
    {
        $this->middleware(['permission:suppliers']);
        $mytime = Carbon::now();
        $this->today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
    }

    public function index()
    {
        $supllier = Supplier::paginate(10);
        return view('admin.supplier.index', compact('supllier'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account($id)
    {
        $supplier =Supplier::find($id);
        $supplierSale =SupplierSale::where('supplier_id',$id)->paginate(25);
        $total =SupplierSale::where('supplier_id',$id)->sum('total');
        $pay =SupplierSale::where('supplier_id',$id)->sum('pay');
        $remain =SupplierSale::where('supplier_id',$id)->sum('remain');
        return view('admin.supplier.supplier_account',compact('supplier','supplierSale','total','remain','pay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:suppliers',
                'phone' => 'required|unique:suppliers',
                'address' => 'required',
            ]);
        $data['user_id'] = Auth::user()->id;
        $user = Supplier::create($data);
        $user->save();
        Alert::success('تم', trans('admin.addedsuccess'));
        return redirect(url('supplier'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Supplier::where('id', $id)->first();
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'bill_id' => 'required|exists:supplier_sales,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'money' => 'required',
                'notes' => '',
            ]);
        $data['user_id'] = Auth::user()->id;
        $data['date'] = $this->today ;
        $supplier_payments = SupplierPayment::create($data);
        if($supplier_payments->save()){
            $bill_id =  $request->input('bill_id');
            $money =  $request->input('money');
            $SupplierSale = SupplierSale::where('id',$bill_id)->first();
            $data_bill['remain'] = $SupplierSale->remain - $money ;
            $data_bill['pay'] = $SupplierSale->pay + $money ;
            $SupplierSale = SupplierSale::where('id',$bill_id)->update($data_bill);
        }
        Alert::success('تم', trans('admin.payment_success'));
        return back();
    }

    public function manula_bill(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'remain' => 'required',
                'supplier_id' => 'required',
                'notes' => ''
            ]);
        $data['user_id'] = Auth::user()->id;
        $data['bill_num'] =trans('admin.old_payment');
        $data['date'] = $this->today ;
        $data['total'] =  $request->input('remain');
        SupplierSale::create($data);
        Alert::success('تم', trans('admin.old_pay_success'));
        return back();
    }

    public function update_Actived(Request $request){
        $data['status'] = $request->status ;
        $user = Supplier::where('id', $request->id)->update($data);
        return 1;
    }
    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:suppliers,name,'.$request->id,
                'phone' => 'required|unique:suppliers,phone,'.$request->id,
                'address' => 'required',
            ]);
        $user = Supplier::whereId($request->id)->update($data);
        Alert::success('تم', trans('admin.updatSuccess'));
        return redirect(url('supplier'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Supplier::where('id', $id)->first();
        try {
            $user->delete();
            Alert::success('تم', trans('admin.deleteSuccess'));
        }catch(Exception $exception){
            Alert::error('خطأ', trans('admin.delete_no_Success'));
        }
        return back();
    }
    public function destroy_payment($id)
    {
        $user = SupplierSale::where('id', $id)->first();
        try {
            $user->delete();
            Alert::success('تم', trans('admin.deleteSuccess'));
        }catch(Exception $exception){
            Alert::success('خطأ', trans('admin.payment_no_delete'));
        }
        return back();
    }
    public function show_bill($id)
    {
        $bill_bases  = SupplierBillBase::where('supplier_sale_id', $id)->paginate(30);
        $bill = SupplierSale::where('id', $id)->first();
        $supplier_id = $bill->supplier_id;
        return view('admin.supplier.bill_bases', compact('bill_bases','supplier_id'));
    }

}
