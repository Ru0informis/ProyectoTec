<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/', function(){
    return view('general');
});
Route::get('/index', function(){
    return view('general');
})-> middleware('auth');

Route::get('autenticar','AutenticarController@autenticar')->name('login');;
Route::post('validar','AutenticarController@validar');
Route::get('salir','AutenticarController@salir');
Route::post('agregar','AutenticarController@agregar');
Route::get('registrar','AutenticarController@registrar');
Route::get('restorePassword', 'AutenticarController@recuperarContraseña');
Route::put('updatePassword','AutenticarController@actualizarContraseña');

Route::get('dashBoard/productos','productosController@index');
Route::post('dashBoard/productos','productosController@store');
Route::get('dashBoard/productos/create','productosController@create');
Route::put('dashBoard/productos/{producto}','productosController@update');
Route::get('dashBoard/productos/{producto}','productosController@show');
Route::delete('dashBoard/productos/{producto}','productosController@destroy');
Route::get('dashBoard/productos/{producto}/edit','productosController@edit');

Route::get('dashBoard','CategoriasController@index');
Route::post('dashBoard','CategoriasController@store');
Route::get('dashBoard/create','CategoriasController@create');
Route::put('dashBoard/{categoria}','CategoriasController@update');
Route::get('dashBoard/{categoria}','CategoriasController@show');
Route::delete('dashBoard/{categoria}','CategoriasController@destroy');
Route::get('dashBoard/{categoria}/edit','CategoriasController@edit');

Route::resource('Usuarios', 'UsuariosController');
Route::resource('Clientes', 'ClientesController');