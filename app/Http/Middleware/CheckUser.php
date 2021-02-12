<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->name !== $request->route('name') || !preg_match("/^([0-9A-Za-z_]+)$/", $request->route('name'))){
            return abort(404);
        }
        return $next($request);
    }
}
