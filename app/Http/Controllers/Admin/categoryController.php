<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Model\Inbox;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class categoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:categories']);
    }

    public function print($id)
    {
        $products = Product::where('category_id', $id)->get();
        return view('admin.category.print_category_products', compact('products'));
    }

    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.category', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $categories = Inbox::paginate(10);
        return view('admin.category.inbox', compact('categories'));

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
                'name' => 'required|unique:categories,name'
            ]);
        $user = Category::create($data);
        $user->save();
        Alert::success('تم', trans('admin.addedsuccess'));
        return back();
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
    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:categories,name,'.$request->id,
            ]);
        $user = Category::where('id', $request->id)->update(['name' => $request->name]);
        Alert::success('تم', trans('admin.updatSuccess'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Category::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', 'لا يمكن حذف تصنيف به منتجات او مواد خام');
        }
        return back();
    }
}
