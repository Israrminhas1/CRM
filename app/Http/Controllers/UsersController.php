<?php

namespace App\Http\Controllers;

use App\Models\userAuthModel;
use App\Models\userMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        //echo 'Hello';
    }

    public function userList(Request $req)
    {
        //$users = DB::table('users')->orderBy('id','DESC')->get();
        $users = DB::table('users as u')
            ->select('u.id', 'u.name as uname', 'u.email', 'r.name as rname')
            ->join('roles as r', 'u.role_id', '=', 'r.id')
            ->orderBy('u.id', 'DESC')
            ->get();
        //if($users)
        //$users = array();
        return view('profile/listusers')->with(compact('users'));
    }

    public function addUser(Request $req)
    {
        $roles = DB::table('roles')->orderBy('name', 'ASC')->get();

        return view('profile/addusers')->with(compact('roles'));
    }

    public function addUserData(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6',
            'role_name' => 'required',
        ]);

        $uid = 0;

        if ($validator->fails()) {
            return redirect('add-users')
                ->withErrors($validator)
                ->withInput();
        } else {
            $userauthmodel = new userAuthModel();
            $userauthmodel->name = $req->name;
            $userauthmodel->email = $req->email;
            $userauthmodel->password = Hash::make($req->password);
            $userauthmodel->role_id = $req->role_name;
            $userauthmodel->save();

            $uid = $userauthmodel->id;

            $req->session()->flash('successMsg', 'User has been added successfully');

            //     return redirect('list-users');
            // }

            $menu = DB::select('select * from roles_menus where role_id = :ip', ['ip' => $req->role_name]);
            //$menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
            foreach ($menu as $men) {
                $rolemenumodel = new userMenuModel();
                $rolemenumodel->menu_id = $men->menu_id;
                $rolemenumodel->user_id = $uid;
                $rolemenumodel->r_view = 'Y';
                $rolemenumodel->save();
            }
            // logs
            $logs = new LogsController();
            $logs_desc = 'New User "' . $req->name . '" was Created';
            $logs->insertlog($logs_desc);

            // $roles = DB::table('roles')->orderBy('name', 'ASC')->get();
            return redirect('list-users');
            // return view('addusers')->with(compact('roles'));
        }
    }

    public function editUser($id, Request $req)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->orderBy('name', 'ASC')->get();

        if (!$user) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('profile/list-users');
        }

        return view('profile/editusers', ['user' => $user, 'roles' => $roles]);
        //return view('editusers')->with(compact('user'));
    }

    public function updateUser($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:100',
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|min:6',
            'role_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/edit-users/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $userauthmodel = userAuthModel::find($id);
            $userauthmodel->name = $req->name;
            $userauthmodel->email = $req->email;
            if ($req->password != '') {
                $userauthmodel->password = Hash::make($req->password);
            }
            $userauthmodel->role_id = $req->role_name;
            $userauthmodel->save();

            if ($userauthmodel->wasChanged('role_id')) {
                $del = DB::table('users_menus')->where('user_id', $id)->delete();

                $menu = DB::select('select * from roles_menus where role_id = :ip', ['ip' => $req->role_name]);
                //$menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
                foreach ($menu as $men) {
                    $rolemenumodel = new userMenuModel();
                    $rolemenumodel->menu_id = $men->menu_id;
                    $rolemenumodel->user_id = $id;
                    $rolemenumodel->r_view = 'Y';
                    $rolemenumodel->save();
                }
            }

            // logs
            $logs = new LogsController();
            $logs_desc = 'New User "' . $req->name . '" was Updated';
            $logs->insertlog($logs_desc);

            $req->session()->flash('successMsg', 'User has been updated successfully');

            return redirect('list-users');
        }
    }

    public function deleteUser($id, Request $req)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-users');
        }

        DB::table('users')->where('id', $id)->delete();
        // logs
        $logs = new LogsController();
        $logs_desc = 'User "' . $user->name . '" was Deleted';
        $logs->insertlog($logs_desc);

        $req->session()->flash('successMsg', 'User has been deleted successfully');

        return redirect('list-users');
    }

    public function updateProfileInformation(Request $req)
    {
        $user = DB::table('users')->where('id', auth()->user()->id)->first();

        $validator = Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:5000', 'mimes:jpeg,jpg,png'],
        ]);

        if ($validator->fails()) {
            return redirect('user/profile')
                ->withErrors($validator)
                ->withInput();
        } else {

            if (isset($req->photo)) {
                $file = $req->file('photo');

                $fi = request()->file('photo')->store('/');

                //Move Uploaded Fil
                $destinationPath = 'profile';

                $file->move($destinationPath, $fi);

                $filename = $destinationPath . '/' . $fi;

                $userauthmodel = userAuthModel::find($user->id);
                $userauthmodel->profile_photo_path = $filename;
                $userauthmodel->updated_at = date('Y-m-d H:i:sa');
                $userauthmodel->save();
                // $user->updateProfilePhoto($req->photo);
            }

            if ($req->email !== $user->email) {
                $userauthmodel1 = userAuthModel::find($user->id);
                $userauthmodel1->email = $req->email;
                $userauthmodel2->updated_at = date('Y-m-d H:i:sa');
                $userauthmodel1->save();
            }
            if ($req->name !== $user->name) {
                $userauthmodel2 = userAuthModel::find($user->id);

                $userauthmodel2->name = $req->name;
                $userauthmodel2->updated_at = date('Y-m-d H:i:sa');
                $userauthmodel2->save();
            }
            // logs
            $logs = new LogsController();
            $logs_desc = 'User "' . $user->name . '" Updated His Profile';
            $logs->insertlog($logs_desc);

            return redirect('user/profile');
        }
    }

    public function updateUserPassword(Request $req)
    {
        $user = DB::table('users')->where('id', auth()->user()->id)->first();
        $reqs = $req->all();
        $validator = Validator::make($req->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'same:confirm_password'],
            'confirm_password' => ['required'],
        ]);
        if (!Hash::check($req->current_password, $user->password)) {
            $validator->errors()->add('current_password', __('The provided password does not match your current password.'));

            return redirect('user/profile')
                ->withErrors($validator)
                ->withInput();
        } elseif ($validator->fails()) {
            return redirect('user/profile')
                ->withErrors($validator)
                ->withInput();
        } else {
            $userauthmodel = userAuthModel::find($user->id);

            $userauthmodel->password = Hash::make($req->password);
            $userauthmodel->save();

            // logs
            $logs = new LogsController();
            $logs_desc = 'User "' . $user->name . '" Password was Changed ';
            $logs->insertlog($logs_desc);

            return redirect('user/profile');
        }
    }
}
