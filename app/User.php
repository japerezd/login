<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        //este modelo pertenece a muchos
        return $this->belongsToMany('App\Role');
    }

    //Pasando array de roles y despues se obtiene el modelo actual del User
    //se checa el belongMany y checamos si cualquiera de los roles estan en la columna name en la tabla roles
    //Si se obtiene uno de los roles devuelve true
    public function hasAnyRoles($roles)
    {
        return null !==$this->roles()->whereIn('name',$roles)->first();
    }

    //Solo se pasa un solo unico role
    public function hasAnyRole($role)
    {
        return null !==$this->roles()->where('name',$role)->first();
    }
}

