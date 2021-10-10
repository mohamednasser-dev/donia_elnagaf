<?php

namespace App\Http\Controllers\Admin;

use App\Models\Login_history;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Model_has_role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class usersController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
        $this->middleware(['permission:employees']);
        $this->objectName = $model;
        $this->folderView = 'admin.users.';
    }

    public function index()
    {
        $users = $this->objectName::where('branch_number' , Auth()->user()->branch_number)->where('deleted', '0')
            ->where('type', 'user')->orderBy('name', 'desc')->paginate(10);
        return view($this->folderView . 'users', compact('users'));
    }

    public function chart_branches()
    {
        $users = $this->objectName::where('deleted', '0')->where('type', 'user')->orderBy('name', 'desc')->paginate(10);
        return view($this->folderView . 'charts.index', compact('users'));
    }

    public function charts($id)
    {
        $sales_emp_names[] = null;
        $sales_total_payments[] = null;

        $stores_emp_names[] = null;
        $stores_total_payments[] = null;

        //for chart 2
        $users = $this->objectName::where('deleted', '0')->where('type', 'user')->where('specialist', 'sales')
            ->where('branch_number', $id)->orderBy('name', 'desc')->paginate(10);
        foreach ($users as $key => $row) {
            $sales_emp_names[$key] = $row->name;
            $sales_total_payments[$key] = $row->total_payment;
        }

        //for chart 3
        $users = $this->objectName::where('deleted', '0')->where('type', 'user')->where('specialist', 'stores')
            ->where('branch_number', $id)->orderBy('name', 'desc')->paginate(10);
        foreach ($users as $key => $row) {
            $stores_emp_names[$key] = $row->name;
            $stores_total_payments[$key] = $row->total_payment;
        }
        $sales_emp_names = json_encode($sales_emp_names);
        $sales_total_payments = json_encode($sales_total_payments);

        $stores_emp_names = json_encode($stores_emp_names);
        $stores_total_payments = json_encode($stores_total_payments);

        return view($this->folderView . 'charts.charts', compact('sales_emp_names', 'sales_total_payments', 'stores_emp_names', 'stores_total_payments'));
    }

    public function show($id)
    {
        $data = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'details', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();
        return view($this->folderView . 'create_user', compact('roles'));
    }

    public function store(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users',
                'email' => 'required|unique:users',
                'phone' => 'required',
                'branch_number' => 'required',
                'image' => '',
                'specialist' => '',
                'ident_image' => '',
                'fesh_image' => '',
                'role_id' => 'required|exists:roles,id',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            if ($request->status == 'on') {
                $data['status'] = 'active';
            } else {
                $data['status'] = 'unactive';
            }
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/users_images');
            }
            if ($request->ident_image != null) {
                $data['ident_image'] = $this->MoveImage($request->ident_image, 'uploads/users_images/ident_images');
            }
            if ($request->fesh_image != null) {
                $data['fesh_image'] = $this->MoveImage($request->fesh_image, 'uploads/users_images/fesh_images');
            }
            $data['branch_number'] = Auth::user()->branch_number ;
            $user = User::create($data);
            if ($user->save()) {
                $user->assignRole($request['role_id']);
                Alert::success('تم', trans('admin.addedsuccess'));
                return redirect(url('users/create'));
            }
        }
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user_data = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', \compact('user_data', 'roles'));
    }

    public function login_history()
    {
        $data = Login_history::orderBy('created_at', 'desc')->paginate(20);
        return view($this->folderView . 'user_login', compact('data'));
    }

    public function login_times()
    {
        $data = Login_history::orderBy('created_at', 'desc')->paginate(20);
        return view($this->folderView . 'user_login', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if ($request['password'] != null) {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'password' => 'required|min:6|confirmed',
                    'role_id' => 'required|exists:roles,id'
                ]);
        } else {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'role_id' => 'required|exists:roles,id'
                ]);
        }
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            $newData['name'] = $request['name'];
            User::where('id', $id)->update($data);
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->update(['role_id' => $request['role_id']]);
            Alert::success('تم', trans('admin.updatSuccess'));
            return redirect(url('users'));
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
            User::where('id', $id)->update($data);
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->update(['role_id' => $request['role_id']]);
            Alert::success('تم', trans('admin.updatSuccess'));
            return redirect(url('users'));
        }
    }

    public function update_Actived(Request $request)
    {
        $data['status'] = $request->status;
        $user = User::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy($id)
    {
        $user = $this->objectName::where('id', $id)->first();
        try {
            $user->deleted = '1';
            $user->save();
            Alert::warning('الحذف', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            Alert::error('خطأ', trans('admin.emp_no_delete'));
        }
        return back();
    }
}
