<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->role == 1){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này( phải là quản trị viên)!!');
        }
        return $next($request);
    }
}
