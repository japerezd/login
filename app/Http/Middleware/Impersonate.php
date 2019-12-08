<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Impersonate
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
        //checar la session primero
        if(session()->has('impersonate')){ //checando si tiene la key impersonate
            //queremos obtener el id fuera de nuestra sesión
            Auth::onceUsingId(session('impersonate')); //creara una sesion una vez, usando el id que pusimos en la sesion

        }
        return $next($request);
    }
}
