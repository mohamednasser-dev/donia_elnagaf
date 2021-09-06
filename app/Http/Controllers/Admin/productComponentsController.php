<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Base;

class productComponentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:products']);
    }
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.productsCompnents.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type','product')->get();
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);

        return view('admin.productsCompnents.create', compact('bases','categories'));

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
                'name' => 'required|unique:products',
                'barcode' => 'required|unique:products',
                'price' => 'required',
                'total_cost' => 'required',
                'gomla_price' => 'required',
                'selling_price' => 'required'
            ]);
        $data['user_id'] = Auth::user()->id;
        $data['total_cost'] = 0;


        if($request->categories != null){
            unset($data['categories']);
            foreach ($request->categories as $key => $row){
                $data['category_id'] = $row;
                if($request->quantity[$row-1] != null){
                    $data['quantity'] = $request->quantity[$row-1];
                    Product::create($data);
                }
            }
        }else{

            Alert::warning('تنبية', 'يجب أختيار مخزن اولا');
            return redirect(url('products'));
        }

        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('products'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'quantity' => 'required|numeric',
                'id' => 'required',

            ]);
        $product = Product::whereId($request->id)->first();
        $product->quantity = $product->quantity + $request->quantity;
        $product->save();
        session()->flash('success', 'تم اضافه الكميه بنجاح!');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('Bases')->first();
        return view('admin.productsCompnents.edit', compact('product'));
    }
    public function edit_price()
    {
//        $product = Product::where('id', $id)->with('Bases')->first();
//        , compact('product')
        return view('admin.productsCompnents.edit_price');
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
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:products,name,' . $id,
                'barcode' => 'required|unique:products,barcode,' . $id,
                'image' => 'sometimes|nullable',
                'gomla_price' => 'required',
                'selling_price' => 'required',
                'category_id' => 'required',
                'quantity' => 'required',
            ]);
        $data['user_id'] = Auth::user()->id;
        if ($request->image != null) {
            $data['image'] = $this->MoveImage($request->image);

        }
        $product = Product::whereId($id)->update($data);
        session()->flash('success', trans('admin.updatSuccess'));
        return redirect(url('products'));
    }

    public function search_price(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'barcode' => 'required',
                'price' => 'required',
            ]);

        $product = Product::where('barcode',$request->barcode)->get();
        if($product->count() > 0){
            $input['selling_price'] = $request->price ;
            Product::where('barcode',$request->barcode)->update($input);
            session()->flash('success', 'تم تعديل سعر البيع بنجاح');
            return redirect()->back();
        }else{
            session()->flash('danger', 'لا يوجد منتجات بهذا الباركود');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Product::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', '!لا يمكن حذف المنتج');
        }
        return back();
    }

}
