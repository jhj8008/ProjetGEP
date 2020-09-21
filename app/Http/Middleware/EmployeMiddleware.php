<?php

namespace App\Http\Middleware;

//use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class EmployeMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    /*protected function redirectTo($request)
    {
        if(auth()->guest()){
            return route('loginEmploye');
        }
        if (!auth()->user()->admin) {
            return redirect('/');
        }
    }*/

    public function handle($request, Closure $next, $guard = null)
    {
        
        if(Auth::guard('employe')->guest() && auth()->guest()){
            return redirect('loginEmploye');
        }else if(auth()->check()){
            return redirect('/');
        }
        /*if(auth()->guest()){
            return redirect('loginEmploye');
        }*/
        /*if(!auth()->user()->admin){
            return redirect('/');
        }*/

        return $next($request);
    }
}
