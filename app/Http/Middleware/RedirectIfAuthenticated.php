<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if(!empty(Auth::guard('employe')->user()->nom) or !empty(Auth::guard('auth')->user()->nom_père)){
            return redirect(RouteServiceProvider::HOME);
        }*/
        /*switch($guard){
            case 'employe':
                if (Auth::guard($guard)->check()) {
                    return redirect('/espace_personnel');
                }
            default:
                if (Auth::guard($guard)->check()) {
                    return $next($request);
                }
        }*/
        /*if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }*/

        return $next($request);
    }
}
