<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;

class ProfileController extends Controller
{
    public function profile_bank(Request $request)
    {
        return view('bank.profile_bank');
    }

    public function update(Request $request)
    {

        $id = Auth::user()->id;
        $employee = User::find($id);

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data = $this->validate(\request(),
                [
                    'name' => 'required|unique:users,name,' . $id,
                    'email' => 'required|unique:users,email,' . $id,
                    'phone' => 'required|unique:users,phone,' . $id,
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ]);
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
        } else {
            $data = $this->validate(\request(),
                [
                    'name' => 'required|unique:users,name,' . $id,
                    'email' => 'required|unique:users,email,' . $id,
                    'phone' => 'required|unique:users,phone,' . $id,
                ]);
        }

        User::where('id', $id)->update($data);

        // Alert::success( 'تمت العمليه','تم تحديث معلومات الحساب');
        return redirect()->back()->with('success', trans('تم تحديث معلومات الحساب بنجاح'));
    }

    public function updatepassword(Request $request)
    {
        $id = Auth::user()->id;
        $data = $this->validate(\request(),
            [
                'old_password' => ['required'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        $employer = User::find($id);
        if (Hash::check($request->old_password, $employer->password)) {
            $data['password'] = bcrypt(request('password'));
            unset($data['old_password']);
            User::where('id', $id)->update($data);
            Alert::success('تمت العمليه', 'تم تحديث كلمه مرور الحساب');
            return redirect()->route('viewprofile', Auth::user()->id);
        } else {
            return redirect()->back()->with(["wrong_pass" => 'كلمه المرور القديمه خاطئه']);;
        }
    }

    public function updateimage(Request $request)
    {
        $id = Auth::user()->id;
        $data = $this->validate(request(),
            [
                'image' => 'required',
            ]);
        if ($request->image != null) {
            $employee = User::find($id);
            $image = explode("/", $employee->image);
            $length = count($image) - 1;//the name of photo in the last index in array
            $data['image'] = $this->MoveImage($request->image, 'uploads/admins_image');
            User::where('id', $id)->update($data);
            if ($employee->image !== null) {
                unlink("uploads/admins_image/" . $image[$length]);
            }
            // activity('admin')->log('تم تحديث الموظف بنجاح');
            // Alert::success('تمت العمليه','تم تحديث صوره الحساب');
            return redirect()->route('viewprofile', Auth::user()->id)->with('success', trans('تم تحديث صوره الحساب بنجاح'));
        } else {
            return redirect()->back();
        }
    }
}

