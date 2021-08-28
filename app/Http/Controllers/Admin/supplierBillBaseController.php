<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierBillBase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class supplierBillBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user_type = auth()->user()->type;
        if (request()->ajax()) {
            return datatables()->of(SupplierBillBase::all())
                ->addColumn('action', function ($data) {
                    $button .= '<button data-client-id="' . $data->id . '" id="deleteClient"  class="btn btn-xs btn-outline-danger" ><i
                            class="fa fa-times fa fa-white"></i>&nbsp;&nbsp;' . trans('site_lang.public_delete_text') . '</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.base_bills.base_bills');
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
        dd('here');
        //to get today date
        $mytime = Carbon::now();
        $today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
            $data = $this->validate(request(), [
                'supplier_sale_id' => 'required|exists:supplier_sales,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'base_id' => 'required|exists:bases,id',
                'quantity' => 'required',
                'price' => 'required',
            ]);
            $data['date'] = $today;
            $data['user_id'] = Auth::user()->id;
        SupplierBillBase::create($data);
        return response()->json(['success' => trans('site_lang.addedsuccess')]);
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
