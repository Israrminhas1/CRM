<?php

namespace App\Http\Controllers;

use App\Models\roleMenuModel;
use App\Models\roleModel;
use App\Models\userMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    public function rolesList(Request $req)
    {
        $roles = DB::table('roles')->orderBy('name', 'DESC')->get();
        //if($users)
        //$users = array();
        return view('profile/listroles')->with(compact('roles'));
    }

    public function addRoles(Request $req)
    {
        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);
        //$menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/addroles', ['menus' => $menus]);
    }

    public function assignPermission(Request $req)
    {
        //dd($req['view-check']);

        $validator = Validator::make($req->all(), [
            'role_name' => 'required|max:100|unique:roles,name',
            'view-check' => 'required',
        ]);

        if ($validator->fails()) {
            //$req->session()->flash('errorMsg','Role name is required');
            return redirect('/add-roles')
                ->withErrors($validator)
                ->withInput();
        } else {
            $rolemodel = new roleModel();
            $rolemodel->name = $req->role_name;
            $rolemodel->save();

            $roleid = $rolemodel->id;

            if (isset($req['view-check'])) {
                foreach ($req['view-check'] as $vw) {
                    $rolemenumodel = new roleMenuModel();
                    $rolemenumodel->menu_id = $vw;
                    $rolemenumodel->role_id = $roleid;
                    $rolemenumodel->r_view = 'Y';
                    $rolemenumodel->save();
                }
            }

            if (isset($req['master-check'])) {
                foreach ($req['master-check'] as $vw) {
                    $rolemenumodel = new roleMenuModel();
                    $rolemenumodel->menu_id = $vw;
                    $rolemenumodel->role_id = $roleid;
                    $rolemenumodel->r_view = 'Y';
                    $rolemenumodel->save();
                }
            }


            $req->session()->flash('successMsg', 'Role has been created successfully');

            return redirect('add-roles');
        }
        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);

        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/addroles', ['menus' => $menus]);
    }

    public function viewSelectedPermission($id, Request $req)
    {

        $roleid = $id;
        $rm_view = [];

        if ($roleid) {

            $rolesmenus = DB::select('select * from roles_menus where role_id = :rid', ['rid' => $roleid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }
        }

        $roles = DB::table('roles')->orderBy('name', 'ASC')->get();

        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);
        //$menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/viewroles', ['menus' => $menus, 'roles' => $roles, 'rm_view' => $rm_view/*, 'rm_add' => $rm_add, 'rm_edit' => $rm_edit, 'rm_delete' => $rm_delete*/, 'rolename' => $roleid]);
    }

    public function viewPermission(Request $req)
    {

        $roleid = '';
        $rm_view = [];

        if ($req->role_name) {
            $roleid = $req->role_name;
            $rolesmenus = DB::select('select * from roles_menus where role_id = :rid', ['rid' => $roleid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }
        }

        $roles = DB::table('roles')->orderBy('name', 'ASC')->get();

        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);


        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;



            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/viewroles', ['menus' => $menus, 'roles' => $roles, 'rm_view' => $rm_view/*, 'rm_add' => $rm_add, 'rm_edit' => $rm_edit, 'rm_delete' => $rm_delete*/, 'rolename' => $roleid]);
    }

    public function editPermission($id, Request $req)
    {

        $roleid = $id;
        $rm_view = [];

        if ($roleid) {

            $rolesmenus = DB::select('select * from roles_menus where role_id = :rid', ['rid' => $roleid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }


            $roles = DB::table('roles')->where('id', $roleid)->first();
        }



        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);

        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/editroles', ['menus' => $menus, 'roles' => $roles, 'rm_view' => $rm_view/*, 'rm_add' => $rm_add, 'rm_edit' => $rm_edit, 'rm_delete' => $rm_delete*/, 'rolename' => $roleid]);
    }

    public function updatePermission($id, Request $req)
    {


        $validator = Validator::make($req->all(), [
            'name' => ['required', Rule::unique('roles')->ignore($id)],
            'view-check' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/edit-roles/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $del = DB::table('roles_menus')->where('role_id', $id)->delete();

            $rolemodel = roleModel::find($id);
            $rolemodel->name = $req->name;
            $rolemodel->save();

            $roleid = $id;

            if (isset($req['view-check'])) {
                foreach ($req['view-check'] as $vw) {
                    $rolemenumodel = new roleMenuModel();
                    $rolemenumodel->menu_id = $vw;
                    $rolemenumodel->role_id = $roleid;
                    $rolemenumodel->r_view = 'Y';
                    $rolemenumodel->save();
                }
            }

            if (isset($req['master-check'])) {
                foreach ($req['master-check'] as $vw) {
                    $rolemenumodel = new roleMenuModel();
                    $rolemenumodel->menu_id = $vw;
                    $rolemenumodel->role_id = $roleid;
                    $rolemenumodel->r_view = 'Y';
                    $rolemenumodel->save();
                }
            }



            $req->session()->flash('successMsg', 'Role has been updated successfully');
        }

        $rm_view = [];

        if ($roleid) {

            $rolesmenus = DB::select('select * from roles_menus where role_id = :rid', ['rid' => $roleid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }
        }

        $roles = DB::table('roles')->where('id', $id)->first();



        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);

        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/editroles', ['menus' => $menus, 'roles' => $roles, 'rm_view' => $rm_view/*, 'rm_add' => $rm_add, 'rm_edit' => $rm_edit, 'rm_delete' => $rm_delete*/, 'rolename' => $roleid]);
    }

    public function editPermissionUser($id, Request $req)
    {

        $uid = $id;
        $rm_view = [];

        if ($uid) {
            //$roleid = $req->role_name;
            $rolesmenus = DB::select('select * from users_menus where user_id = :rid', ['rid' => $uid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }
        }



        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);

        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/editroles-users', ['menus' => $menus, 'uid' => $uid, 'rm_view' => $rm_view]);
    }

    public function updatePermissionUser($id, Request $req)
    {



        $del = DB::table('users_menus')->where('user_id', $id)->delete();

        $uid = $id;

        if (isset($req['view-check'])) {
            foreach ($req['view-check'] as $vw) {
                $rolemenumodel = new userMenuModel();
                $rolemenumodel->menu_id = $vw;
                $rolemenumodel->user_id = $uid;
                $rolemenumodel->r_view = 'Y';
                $rolemenumodel->save();
            }
        }

        if (isset($req['master-check'])) {
            foreach ($req['master-check'] as $vw) {
                $rolemenumodel = new userMenuModel();
                $rolemenumodel->menu_id = $vw;
                $rolemenumodel->user_id = $uid;
                $rolemenumodel->r_view = 'Y';
                $rolemenumodel->save();
            }
        }

        $req->session()->flash('successMsg', 'User Rights have been updated successfully');



        $rm_view = [];

        if ($uid) {

            $rolesmenus = DB::select('select * from users_menus where user_id = :rid', ['rid' => $uid]);
            foreach ($rolesmenus as $rm) {
                if ($rm->r_view == 'Y') {
                    array_push($rm_view, $rm->menu_id);
                }
            }
        }

        $menu = DB::select('select * from menus where is_parent = :ip', ['ip' => 0]);
        //$menu = DB::table('menus')->orderBy('sort_order','ASC')->get();
        foreach ($menu as $men) {
            $menus[$men->id]['name'] = $men->name;
            $menuchild = DB::select('select * from menus where is_parent = :ip', ['ip' => $men->id]);
            $menus[$men->id]['child'] = $menuchild;
        }

        return view('profile/editroles-users', ['menus' => $menus, 'uid' => $uid, 'rm_view' => $rm_view]);
    }

    public function deleteRoles($id, Request $req)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        if (!$role) {
            $req->session()->flash('errorMsg', 'Record Not Found');

            return redirect('list-roles');
        }

        DB::table('roles')->where('id', $id)->delete();
        $req->session()->flash('successMsg', 'Role has been deleted successfully');

        return redirect('list-roles');
    }
}
