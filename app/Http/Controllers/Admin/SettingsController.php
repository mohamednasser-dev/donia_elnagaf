<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        //outgoing
        $data = Setting::find(1);
        return view('admin.settings', compact('data'));

    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required',
                'open_time' => 'required',
                'close_time' => 'required',
            ]);
        Setting::where('id',1)->update($data);
        session()->flash('success', trans('admin.updatSuccess'));
        return redirect()->back();
    }
}
