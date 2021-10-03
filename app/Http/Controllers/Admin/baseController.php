<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class baseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:bases']);
    }

    public function index()
    {
        $bases = Base::paginate(10);
        return view('admin.base.index', compact('bases'));

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
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:bases',
                'quantity' => 'required',
//                'alarm_quantity' => 'required',
                'price' => 'required',
                'purchas_price' => 'required',
                'barcode' => 'required|unique:bases',
                'measur_unit' => 'required',
                'category_id' => 'required',
            ]);
        $data['user_id'] = Auth::user()->id;
        Base::create($data);
        Alert::success('تم', trans('admin.addedsuccess'));
        return redirect(url('bases'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Base::where('id', $id)->first();
        return response()->json(['data' => $data]);
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
    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:bases,name,'.$request->id,
                'quantity' => 'required',
//                'alarm_quantity' => 'required',
                'price' => 'required',
                'purchas_price' => 'required',
                'barcode' => 'required|unique:bases,barcode,'.$request->id,
                'measur_unit' => 'required',
                'category_id' => 'required',
            ]);
        Base::whereId($request->id)->update($data);
        Alert::success('تم',  trans('admin.updatSuccess'));
        return redirect(url('bases'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Base::where('id', $id)->first();
        try {
            $user->delete();
            Alert::success('تم',   trans('admin.deleteSuccess'));
        }catch(Exception $exception){
            Alert::error('خطأ',   '!لا يمكن حذف  مواد خام مستخدمه فى منتجات');
        }
        return back();
    }

}
