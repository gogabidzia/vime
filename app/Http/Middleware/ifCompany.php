<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Company;
class ifCompany
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
        if(Auth::check() && Auth::user()->company){
            return $next($request);
        }
        return redirect('/');
    }
}
