<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin
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
        if(\App\Models\users::where('username', $request -> session() -> get('username'))  ->where(function ($query) {
            $query->where('role', '1')
                ->orWhere('role', '2');
        }) -> exists() && $request -> session() -> get('username')){
            return $next($request);
        }else{
            return redirect(route('admin_accounts_web'));
        }
    }
}
