<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product_history;
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
        $selected_cat = Category::orderBy('id', 'asc')->first()->id;
        $products = Product::where('category_id', $selected_cat)->where('deleted','0')->paginate(20);
        return view('admin.productsCompnents.index', compact('products', 'selected_cat'));
    }

    public function create()
    {
        $categories = Category::where('type', 'product')->get();
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);
        $last_barcode = Product::orderBy('barcode','desc')->first();
        if($last_barcode){
            $auto_barcode = $last_barcode->barcode +1 ;
        }else{
            $auto_barcode = 100001 ;
        }
        return view('admin.productsCompnents.create', compact('bases', 'categories','auto_barcode'));
    }

    public function create_duplicate($id)
    {
        $basic_product = Product::find($id);
        $categories = Category::where('type', 'product')->get();
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);

        return view('admin.productsCompnents.duplicate_create', compact('bases', 'categories','basic_product'));
    }

    public function filter_category(Request $request)
    {
        $selected_cat = $request->category_id;
        $products = Product::where('category_id', $selected_cat)->where('deleted','0')->paginate(20);
        return view('admin.productsCompnents.index', compact('products', 'selected_cat'));
    }
    public function filter_name(Request $request)
    {
        $selected_cat = $request->category_id;
        $products = Product::where('name','like','%'.$request->search.'%')->where('deleted','0')->paginate(20);
        return view('admin.productsCompnents.index', compact('products', 'selected_cat'));
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


        if ($request->categories != null) {
            unset($data['categories']);
            foreach ($request->categories as $key => $row) {
                $data['category_id'] = $row;
                if ($request->quantity[$row - 1] != null) {
                    $data['quantity'] = $request->quantity[$row - 1];
                    $result = Product::create($data);
                    $history_data['product_name'] = $request->name;
                    $history_data['notes'] = 'اضافة منتج جديد';
                    $history_data['quantity'] = $request->quantity[$row - 1];
                    $history_data['gomla_price'] = $request->gomla_price;
                    $history_data['selling_price'] = $request->selling_price;
                    $history_data['product_id'] = $result->id;
                    $history_data['category_id'] = $row;
                    $history_data['type'] = 'add';
                    $history_data['user_id'] = Auth::user()->id;
                    Product_history::create($history_data);
                }
            }
        } else {
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
                'id' => 'required'
            ]);
        $product = Product::whereId($request->id)->first();
        $product->quantity = $product->quantity + $request->quantity;
        $product->save();

        $history_data['product_name'] = $product->name;
        $history_data['notes'] = 'اضافة كمية جديدة للمنتج';
        $history_data['quantity'] = $request->quantity;
        $history_data['gomla_price'] = $product->gomla_price;
        $history_data['selling_price'] = $product->selling_price;
        $history_data['product_id'] = $request->id;
        $history_data['category_id'] = $product->category_id;
        $history_data['type'] = 'add';
        $history_data['user_id'] = Auth::user()->id;
        Product_history::create($history_data);
        Alert::success('تم', 'تم اضافه الكميه بنجاح!');
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
                'name' => 'required',
                'barcode' => 'required',
                'gomla_price' => 'required',
                'selling_price' => 'required',
                'quantity' => 'required',
            ]);
        $data['user_id'] = Auth::user()->id;
        $basic_product = Product::where('id', $id)->first();

        if ($request->quantity > $basic_product->quantity) {
            $new_quantity = $request->quantity - $basic_product->quantity ;
            $history_data['product_name'] = $basic_product->name;
            $history_data['notes'] = 'تعديل المنتج';
            $history_data['quantity'] = $new_quantity;
            $history_data['gomla_price'] = $basic_product->gomla_price;
            $history_data['selling_price'] = $basic_product->selling_price;
            $history_data['product_id'] = $id;
            $history_data['category_id'] = $basic_product->category_id;
            $history_data['type'] = 'add';
            $history_data['user_id'] = Auth::user()->id;
            Product_history::create($history_data);
        }elseif($request->quantity < $basic_product->quantity){
            $new_quantity = $basic_product->quantity - $request->quantity;
            $history_data['product_name'] = $basic_product->name;
            $history_data['notes'] = 'تعديل المنتج';
            $history_data['quantity'] = $new_quantity;
            $history_data['gomla_price'] = $basic_product->gomla_price;
            $history_data['selling_price'] = $basic_product->selling_price;
            $history_data['product_id'] = $id;
            $history_data['category_id'] = $basic_product->category_id;
            $history_data['type'] = 'remove';
            $history_data['user_id'] = Auth::user()->id;
            Product_history::create($history_data);
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
        $product = Product::where('barcode', $request->barcode)->where('deleted','0')->get();
        if ($product->count() > 0) {
            $input['selling_price'] = $request->price;
            Product::where('barcode', $request->barcode)->update($input);
            Alert::success('تم', 'تم تعديل سعر البيع بنجاح');
            return redirect()->back();
        } else {
            Alert::warning('تنبية', 'لا يوجد منتجات بهذا الباركود');
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
        $product = Product::where('id', $request->product_id)->where('deleted','0')->first();
        if ($product) {
            if ($request->category_id != $product->category_id) {
                $another_product = Product::where('category_id', $request->category_id)->where('barcode', $product->barcode)->where('deleted','0')->first();
                if ($another_product) {
                    $another_product->quantity = $another_product->quantity + $request->quantity;
                    $another_product->save();
                } else {
                    $new_data['name'] = $product->name;
                    $new_data['barcode'] = $product->barcode;
                    $new_data['price'] = $product->price;
                    $new_data['total_cost'] = 0;
                    $new_data['gomla_price'] = $product->gomla_price;
                    $new_data['selling_price'] = $product->selling_price;
                    $new_data['user_id'] = Auth::user()->id;
                    $new_data['quantity'] = $request->quantity;
                    $new_data['category_id'] = $request->category_id;
                    $new_product_added = Product::create($new_data);
                }
                $product->quantity = $product->quantity - $request->quantity;
                $product->save();
                //add to history ...
                $history_data['product_name'] = $product->name;
                $history_data['notes'] = 'اضافة كمية مسحوبة من مخزن اخر';
                $history_data['quantity'] = $request->quantity;
                $history_data['gomla_price'] = $product->gomla_price;
                $history_data['selling_price'] = $product->selling_price;
                $history_data['product_id'] = $request->product_id;
                $history_data['category_id'] = $request->category_id;
                $history_data['type'] = 'add';
                $history_data['user_id'] = Auth::user()->id;
                Product_history::create($history_data);
                //remove to history ...
                $history_data['product_name'] = $product->name;
                $history_data['notes'] = 'سحب الكمية من المخزن الى مخزن اخر';
                $history_data['quantity'] = $request->quantity;
                $history_data['gomla_price'] = $product->gomla_price;
                $history_data['selling_price'] = $product->selling_price;
                $history_data['product_id'] = $request->product_id;
                $history_data['category_id'] = $product->category_id;
                $history_data['type'] = 'remove';
                $history_data['user_id'] = Auth::user()->id;
                Product_history::create($history_data);
                Alert::success('تمت العملية بنجاح', 'تم سحب الكمية الى المخزن المختار');
                return redirect()->back();
            } else {
                Alert::warning('لم يتم سحب الكمية', 'يجب اختيار مخزن اخر غير مخزن المنتج نفسه');
                return redirect()->back();
            }
        } else {
            Alert::warning('خطأ', 'يجب اختيار منتج صحيح اولا');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $user = Product::where('id', $id)->first();
        try {
            $user->deleted = '1';
            $user->save();
            Alert::success('تم', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            Alert::error('خطأ', '!لا يمكن حذف المنتج');
        }
        return back();
    }

    public function product_history()
    {
        $selected_cat = Category::orderBy('id', 'asc')->first()->id;
        $products = Product_history::orderBy('created_at', 'desc')->get();
        $add = Product_history::where('type', 'add')->get()->sum('quantity');
        $remove = Product_history::where('type', 'remove')->get()->sum('quantity');
        $remain = $add - $remove;
        return view('admin.productsCompnents.history.index', compact('products', 'selected_cat', 'add', 'remove', 'remain'));
    }

    public function filter_category_history(Request $request)
    {
        $selected_cat = $request->category_id;
        $products = Product_history::where('category_id', $request->category_id)->orderBy('created_at', 'desc')->get();
        $add = Product_history::where('category_id', $request->category_id)->where('type', 'add')->get()->sum('quantity');
        $remove = Product_history::where('category_id', $request->category_id)->where('type', 'remove')->get()->sum('quantity');
        $remain = $add - $remove;
        return view('admin.productsCompnents.history.index', compact('products', 'selected_cat', 'add', 'remove', 'remain'));
    }

    public function filter_product_name_history(Request $request)
    {
        $selected_cat = Category::orderBy('id', 'asc')->first()->id;
        $products = Product_history::where('product_name', $request->product_name)->orderBy('created_at', 'desc')->get();
        $add = Product_history::where('product_name', $request->product_name)->where('type', 'add')->get()->sum('quantity');
        $remove = Product_history::where('product_name', $request->product_name)->where('type', 'remove')->get()->sum('quantity');
        $remain = $add - $remove;
        return view('admin.productsCompnents.history.index', compact('products', 'selected_cat', 'add', 'remove', 'remain'));
    }
}
