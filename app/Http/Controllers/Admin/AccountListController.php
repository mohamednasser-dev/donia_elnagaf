<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerBill;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AccountListController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Account statement']);
    }

    public function index()
    {
        return view('admin.account_list.accountlist');

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_account = CustomerBill::with('Customer')->where('branch_number', Auth()->user()->branch_number)->where('cust_id', $request->cust_id)
            ->whereBetween('date', [$request->fromdate, $request->todate])->get();
        if (count($customer_account) > 0) {
            $from = $request->fromdate;
            $to = $request->todate;
            return view('admin.account_list.print', compact('customer_account', 'from', 'to'));
        } else {
            Alert::error('تم', 'لا يوجد فواتير');
            return redirect()->back();
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
        //
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
