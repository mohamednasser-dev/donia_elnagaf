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
        $selected_cat = Category::orderBy('id','asc')->first()->id;
        $products = Product::where('category_id',$selected_cat)->paginate(20);
        return view('admin.productsCompnents.index', compact('products','selected_cat'));

    }
    public function create()
    {
        $categories = Category::where('type','product')->get();
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);
        return view('admin.productsCompnents.create', compact('bases','categories'));
    }
    public function filter_category(Request $request)
    {
        $selected_cat = $request->category_id;
        $products = Product::where('category_id',$selected_cat)->paginate(20);
        return view('admin.productsCompnents.index', compact('products','selected_cat'));
    }
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:products',
                'barcode' => 'required|unique:products',
                'price' => 'required',
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
        Alert::success('تم', trans('admin.addedsuccess'));
        return redirect(url('products'));
    }
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
        Alert::success('تم',  'تم اضافه الكميه بنجاح!');
        return back();
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('Bases')->first();
        return view('admin.productsCompnents.edit', compact('product'));
    }
    public function edit_price()
    {
        return view('admin.productsCompnents.edit_price');
    }

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
        Product::whereId($id)->update($data);
        Alert::success('تم', trans('admin.updatSuccess'));
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
            Alert::success('تم','تم تعديل سعر البيع بنجاح');
            return redirect()->back();
        }else{
            Alert::warning('تنبية','لا يوجد منتجات بهذا الباركود');
            return redirect()->back();
        }
    }
    public function pull_quantity(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'quantity' => 'required',
                'product_id' => 'required',
                'category_id' => 'required',
            ]);
        $product = Product::where('id',$request->product_id)->first();
        if($product){
            if($request->category_id != $product->category_id){
                $another_product = Product::where('category_id',$request->category_id)->where('barcode',$product->barcode)->first();
                if($another_product){
                    $another_product->quantity = $another_product->quantity + $request->quantity ;
                    $another_product->save();
                }else{

                    $new_data['name'] = $product->name ;
                    $new_data['barcode'] = $product->barcode ;
                    $new_data['price'] = $product->price ;
                    $new_data['total_cost'] = 0 ;
                    $new_data['gomla_price'] = $product->gomla_price ;
                    $new_data['selling_price'] = $product->selling_price ;
                    $new_data['user_id'] = Auth::user()->id;
                    $new_data['quantity'] = $request->quantity ;
                    $new_data['category_id'] = $request->category_id ;
                    Product::create($new_data);
                }
                $product->quantity = $product->quantity - $request->quantity ;
                $product->save();
                Alert::success('تمت العملية بنجاح', 'تم سحب الكمية الى المخزن المختار');
                return redirect()->back();
            }else{
                Alert::warning('لم يتم سحب الكمية', 'يجب اختيار مخزن اخر غير مخزن المنتج نفسه');
                return redirect()->back();
            }
        }else{
            Alert::warning('خطأ', 'يجب اختيار منتج صحيح اولا');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $user = Product::where('id', $id)->first();
        try {
            $user->delete();
            Alert::success('تم', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            Alert::error('خطأ', '!لا يمكن حذف المنتج');
        }
        return back();
    }
}
