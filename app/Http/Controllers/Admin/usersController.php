<?php
namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Model_has_role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class usersController extends Controller{
    public $objectName;
    public $folderView;

    public function __construct(User $model){
        $this->middleware(['permission:employees']);
        $this->objectName = $model;
        $this->folderView = 'admin.users.';
    }

    public function index(){
        $users = $this->objectName::where('type','user')->orderBy('name','desc')->paginate(10);
        return view($this->folderView.'users',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view($this->folderView.'create_user',compact('roles'));
    }

    public function store(Request $request){
        $data = $this->validate(\request(),
        [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if($request['password'] != null  && $request['password_confirmation'] != null ){
            $data['password'] = bcrypt(request('password'));
            $user = User::create($data);
            if($user->save()){
                $user->assignRole($request['role_id']);
                session()->flash('success', trans('admin.addedsuccess'));
                return redirect(url('users/create'));
            }
        }
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user_data = $this->objectName::where('id', $id)->first();
        return view($this->folderView.'edit', \compact('user_data','roles'));
    }

    public function update(Request $request, $id)
    {
        if($request['password'] != null){
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'password' => 'required|min:6|confirmed',
                    'role_id' => 'required|exists:roles,id'
                ]);
        }else{
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'role_id' => 'required|exists:roles,id'
                ]);
        }
        if($request['password'] != null  && $request['password_confirmation'] != null ){
            $data['password'] = bcrypt(request('password'));
            $newData['name'] =$request['name'];
            User::where('id',$id)->update($data);
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->update(['role_id' => $request['role_id']]);
            session()->flash('success',  trans('admin.updatSuccess'));
            return redirect(url('users'));
        }else{
            unset($data['password']);
            unset($data['password_confirmation']);
            User::where('id',$id)->update($data);
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->update(['role_id' => $request['role_id']]);
            session()->flash('success',  trans('admin.updatSuccess'));
            return redirect(url('users'));
        }
    }

    public function update_Actived(Request $request){
        $data['status'] = $request->status ;
        $user = User::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy($id){
        $user = $this->objectName::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        }catch(Exception $exception){
            session()->flash('danger', trans('admin.emp_no_delete'));
        }
        return back();
    }
}
