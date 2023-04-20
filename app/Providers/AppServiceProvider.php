<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);

        View::composer('*', function ($view) {
            $rights_array = [];
            $rights_id_array = [];
            if (Auth::check()) {
                $users_rights = DB::table('users_menus as um')
                ->select('m.url', 'm.id')
                ->join('menus as m', 'um.menu_id', '=', 'm.id')
                ->where('um.user_id', auth()->user()->id)
                ->get();

                foreach ($users_rights as $ur) {
                    array_push($rights_array, $ur->url);
                    array_push($rights_id_array, $ur->id);
                }
            }

           

            $menu = DB::table('menus')->where('is_parent', 0)->orderBy('sort_order', 'ASC')->get();
            foreach ($menu as $men) {
                $menus[$men->id]['name'] = $men->name;
                $menus[$men->id]['url'] = $men->url;
                $menus[$men->id]['dropdown'] = $men->is_dropdown;
                $menus[$men->id]['icon'] = $men->icon_type;
                $menus[$men->id]['image'] = $men->icon_image;
                $menus[$men->id]['enabled'] = $men->is_enabled;
                if (!in_array($men->id, $rights_id_array)) {
                    $menus[$men->id]['enabled'] = 0;
                }
                $menuchild = [];
                if ($men->is_dropdown == 1) {
                    $menuchild = DB::table('menus')->where('is_parent', $men->id)->where('is_listable', 1)->whereIn('url', $rights_array)->orderBy('sort_order', 'ASC')->get();
                    if (sizeof($menuchild) == 0) {
                        $menus[$men->id]['enabled'] = 0;
                    }
                }
                $menus[$men->id]['child'] = $menuchild;
            }

            $view->with(['menuitems' => $menus, 'rights_array' => $rights_array]);
        });
    }
}
