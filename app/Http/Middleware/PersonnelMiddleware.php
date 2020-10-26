<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class PersonnelMiddleware
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
        if(!Auth::guard('employe')->check()){
            return redirect('/');
        }

        if(Auth::guard('employe')->check() && !Auth::guard('employe')->user()->personnel){
            return redirect('espace_employe')->with('failure', 'Désolé, cet espace est réservé aux personnels uniquement');
        }
        return $next($request);
    }
}
