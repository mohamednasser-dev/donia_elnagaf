<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Outgoing;

class OutgoingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:outgoings']);
    }
    public function index()
    {
        //outgoing
        $outgoings = Outgoing::paginate(10);
        return view('admin.outgoing.outgoing', compact('outgoings'));

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
                'name' => 'required|unique:outgoings',
                'cost' => 'required',
                'date' => 'required|date',
            ]);
        $data['user_id'] = Auth::user()->id;
        $user = Outgoing::create($data);
        $user->save();
        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('outgoing'));
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
        $user = Outgoing::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', 'لا يمكن حذف تصنيف به منتجات او مواد خام');
        }
        return back();
    }
}
