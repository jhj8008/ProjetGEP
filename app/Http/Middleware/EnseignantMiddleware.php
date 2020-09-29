<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class EnseignantMiddleware
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

        if(Auth::guard('employe')->check() && !Auth::guard('employe')->user()->enseignant){
            return redirect('espace_employe');
        }
        return $next($request);
    }
}
