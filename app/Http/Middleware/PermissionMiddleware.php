<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Permission_role;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route_name=Route::currentRouteName();

        $role_id=Auth::user()->role_id;
        $roles=Auth::user()->role()->first();
        //DB::enableQueryLog();
        $key_id=Permission::SELECT('permissions.id')->where('key', 'like',$route_name)
                          ->first();

        $query = DB::getQueryLog();
//print_r($query);exit;
        // print_r($key_id); exit;
        if(!empty( $key_id['id'])){
            $permissions=Permission_role::/*SELECT('permissions.key')->join('permission_roles','permission_roles.permission_id','=','permissions.id')*/


            where('permission_roles.role_id',$role_id)
                /*->Where(function($query) use ($){

                })*/


                ->where('permission_roles.permission_id',$key_id['id'])->get()->toarray();

            //  $query = DB::getQueryLog();
//print_r($query);exit;

            // print_r($permissions);
            // exit;
        }


        if ((!empty($permissions))){

            return $next($request);
        }else{
            return redirect()->back();

        }


    }
}
