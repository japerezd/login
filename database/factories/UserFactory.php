<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Role;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
//pasamos el nuevo usuario y pasarle el faker
$factory->afterCreating(User::class,function ($user,$faker)
{
    //donde el role name es igual a user y despues lo enlazamos con el usuario de arriba
    $roles = Role::where('name','user')->get(); 
    //sync requiere un array de ID la cual quiero sincronizar al usuario
    $user->roles()->sync($roles->pluck('id')->toArray()); //metodo creado en User model
}); 