<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ProductBase;
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
        $bases = Base::pluck('id', 'name');
        $bases = json_encode($bases);

        return view('admin.productsCompnents.create', compact('bases'));

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
                'image' => 'sometimes|nullable',
                'barcode' => 'required|unique:products',
//                'alarm_quantity' => 'required',
                'price' => 'required',
                'total_cost' => 'required',
                'gomla_price' => 'required',
                'selling_price' => 'required',
                'category_id' => 'required',
//                for pivot
                'quantity' => 'required',
//                'base_id*' => 'required',
            ]);
        $data['user_id'] = Auth::user()->id;
        if($request->image != null){
            $data['image'] = $this->MoveImage($request->image);
        }
        $data['total_cost'] = 0;
        $product = Product::create($data);

        session()->flash('success', trans('admin.addedsuccess'));
        return redirect(url('products'));

    }

    public function MoveImage($request_file)
    {
        // This is Image Information ...
        $file = $request_file;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();

        // Move Image To Folder ..
        $fileNewName = 'file' . $size . '_' . time() . '.' . $ext;
        $file->move(public_path('uploads/products'), $fileNewName);

        return $fileNewName;
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
