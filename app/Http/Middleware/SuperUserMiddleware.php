<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class SuperUserMiddleware
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

        if(Auth::guard('employe')->check() && !Auth::guard('employe')->user()->admin){//&& Auth::guard('employe')->user()->email == "hamgimiso@gmail.com"
            return redirect('espace_employe')->with('failure', 'Désolé, cet espace est réservé aux super admins uniquement');
        }else if(Auth::guard('employe')->check() && Auth::guard('employe')->user()->admin && Auth::guard('employe')->user()->email != "hamgimiso@gmail.com"){
            return redirect('espace_admin')->with('failure', 'Désolé, cet espace est réservé aux super admins uniquement');
        }
        
        return $next($request);
    }
}
