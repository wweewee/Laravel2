<?php

namespace App\Http\Middleware;

use Closure;

class isLogin
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
        if(session()->get('home_user_register')){
            return $next($request);
        }else{
            return redirect('home/Login')->with('errors','注册去');
        }

    }
}
