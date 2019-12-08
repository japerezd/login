<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImpersonateController extends Controller
{
    public function index($id) //id del usuario que queremos personalizar
    {
        //obtener el user del database
        $user = User::where('id',$id)->first();
        //si se encontró un user
        if($user){
            session()->put('impersonate',$user->id); //key, value
            
        }

        return redirect('/home'); //hacemos esto porque personalizamos un user que no tiene un acceso de admin
    }

    public function destroy()
    {
        session()->forget('impersonate'); //olvidando el impersonate key

        return redirect('/home');
    }
}
