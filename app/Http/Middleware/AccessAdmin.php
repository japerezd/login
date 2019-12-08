<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
//ESTE MIDDLEWARE ES REGISTRADO EN EL KERNEL 
class AccessAdmin
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
        //checando si el user tiene el rol de admin con authentication
        //obtenemos el user actual y despues utilizamos nuestro metodo creado en User
        if(Auth::user()->hasAnyRoles(['admin'])){
            return $next($request);
        }

        return redirect('home');
    }
}
