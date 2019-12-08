<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\User;

class BladeExtrasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //LLamando al blade y se le da un nombre en el if para referenciarlo en el view
    //$expression será un string que pasamos en una view y dirá que tiene un role
        Blade::if('hasrole',function($expression){
            if(Auth::user()){ //checanco si esta autenticado
                if(Auth::user()->hasAnyRole($expression)){ //checando que tenga un rol
                    return true;
                }  
            }
            return false;
        });

        //se usa esta directiva para mostrar o esconder el impersonating button
        Blade::if('impersonate',function ()
        {
            //verificando si la session tiene la key 'impersonate'
           if(session()->get('impersonate')){
               return true;
           }  
           return false;
        });
    }
}
