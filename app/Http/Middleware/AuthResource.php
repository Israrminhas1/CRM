<?php

namespace App\Http\Middleware;

//namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthResource
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $nexturl)
    {
        // dd($nexturl);
        if (isset($nexturl)) {
            /*$users_rights = DB::table('roles_menus_rights as rmr')
            ->select('rmr.mr_rights')
            ->join('users_roles as ur', 'rmr.role_id', '=', 'ur.role_id')
            ->join('menus as m', 'rmr.menu_id', '=', 'm.id')
            ->where('m.url', $nexturl)
            ->where('ur.user_id', auth()->user()->id)
            ->first();*/
            $users_rights = DB::table('users_menus as um')
            ->select('um.r_view')
            ->join('menus as m', 'um.menu_id', '=', 'm.id')
            ->where('m.url', $nexturl)
            ->where('um.user_id', auth()->user()->id)//auth()->user()->id)
            ->first();
            // dd($users_rights);
            if ($users_rights === null) {
                $request->session()->flash('errorMsg', 'Not Authorized');

                return redirect('/'); //->with('errorMsg', 'Not Authorized');
                //echo url()->current();
                //exit;
                //return back()->with('success', 'Not Authorized');
                //return redirect('list-users')->with('errorMsg', 'Not Authorized');
            }
        }

        return $next($request);
    }
}
