<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerHomeController extends Controller
{
    public function my_orders()
    {
        $orders = Order::where('cust_id', \Auth::guard('customer')->user()->id)->get();
        return view('front.cust_home', compact('orders'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'car_type' => 'required',
                'car_model' => 'required',
                'in_color' => 'required',
                'out_color' => 'required',
                'double_thread_color' => 'required',
                'design_type' => 'required',
                'recieved_date' => 'required',
                'special_request' => 'sometimes|nullable',
                'chaire_image' => 'sometimes|nullable',
                'sofa_image' => 'sometimes|nullable',
                'bill_type' => 'required',
            ]);
        if ($request->chaire_image) {
            $data['chaire_image'] = $this->MoveImage($request->chaire_image);

        }
        if ($request->sofa_image) {
            $data['sofa_image'] = $this->MoveImage($request->sofa_image);

        }

        $data['cust_id'] = \Auth::guard('customer')->user()->id;
        $user = Order::create($data);
         return redirect(url('customer_home'));
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
        $file->move(public_path('uploads/orders'), $fileNewName);

        return $fileNewName;
    }
    public function logout()
    {
        \Auth::guard('customer')->logout();
        return view('front.home');
    }
}
