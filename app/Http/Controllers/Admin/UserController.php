<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //con paginate method nos muestra los 10 primeros items y despues se tiene que hacer la paginacion en index.blade.php
        return view('admin.users.index')->with('users',User::paginate(10)); //estamos pasando users a la vista para el foreach
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //que los usuarios no se puedan editar asimismos y que el admin no se elimine a si mismo
        if(Auth::user()->id== $id){
            return redirect()->route('admin.users.index')->with('warning','No tienes permitido editarte a ti mismo.');
        }

        return view('admin.users.edit')->with(['user'=>User::find($id), 'roles'=>Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(Auth::user()->id== $id){
            return redirect()->route('admin.users.index')->with('warning','No tienes permitido editarte a ti mismo.');
        }

        //encontrando el usuario que intentamos editar
        $user = User::find($id);
        $user->roles()->sync($request->roles); //sync toma un array de items
        return redirect()->route('admin.users.index')->with('success','Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if(Auth::user()->id== $id){
            return redirect()->route('admin.users.index')->with('warning','No tienes permitido eliminarte a ti mismo.');
        }

        //User::destroy($id);
        
        $user = User::find($id);
        if($user){
            $user->roles()->detach(); //detach elimina la relacion desde role_user table
            $user->delete();
            return redirect()->route('admin.users.index')->with('success','Usuario eliminado exitosamente.');
        }

        return redirect()->route('admin.users.index')->with('warning','Este usuario no puede ser eliminado.');
    }
}
