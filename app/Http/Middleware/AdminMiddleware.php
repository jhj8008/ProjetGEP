<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
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
        /*if(auth()->guest()){
            return redirect('/');
        }

        if(!auth()->user()->admin){
            return redirect('/');
        }*/

        if(!Auth::guard('employe')->check()){
            return redirect('/');
        }

        if(Auth::guard('employe')->check() && !Auth::guard('employe')->user()->admin){
            return redirect('espace_employe')->with('failure', 'Désolé, cet espace est réservé aux admins uniquement');
        }
        return $next($request);
    }
}
