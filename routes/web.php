<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function ()
{
    return 'You are admin';
})->middleware(['auth','auth.admin']);


//no pone el admin enfrente de nuestros controladores
//admin. lo pone enfrente de todos nuestros controladores
Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    //con except no se mostraran esos metodos en nuestro UsersController
    Route::resource('/users','UserController',['except'=>['show','create','store']]);
    Route::get('/impersonate/user/{id}','ImpersonateController@index')->name('impersonate');
});

//creando el metodo destroy. Cuando la personalizacion comienza no pasará el middleware de admin. Por eso esta fuera
//del grupo este Route
Route::get('/admin/impersonate/destroy','Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');