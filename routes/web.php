<?php

use App\Models\Categoria;
use App\Models\Usuario;
use App\Models\Producto;
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
    $categorias = Categoria::all();
    return view('anonimo.listCategories', compact('categorias'));
});

Route::get('index', function(){
    $usuarios = Usuario::all();
    $productos = Producto::all();
    $categorias = Categoria::all();
    return view('estadisticas', compact('usuarios', 'categorias', 'productos'));
})-> middleware('auth');

Route::get('autenticar','AutenticarController@autenticar')->name('login');;
Route::post('validar','AutenticarController@validar');
Route::get('salir','AutenticarController@salir');
Route::post('agregar','AutenticarController@agregar');
Route::get('registrar','AutenticarController@registrar');
Route::get('restorePassword', 'AutenticarController@recuperarContraseña');
Route::put('updatePassword','AutenticarController@actualizarContraseña');


Route::get('dashBoard/productos/concesionar/{id}','productosController@concesionarView');
Route::post('dashBoard/productos/concesionar/{id}/concesionar','productosController@concesionarProducto');
Route::get('dashBoard/productos','productosController@index');
Route::post('dashBoard/productos','productosController@store');
Route::get('dashBoard/productos/create','productosController@create');
Route::put('dashBoard/productos/{producto}','productosController@update');
Route::get('dashBoard/productos/{producto}','productosController@show');
Route::delete('dashBoard/productos/{producto}','productosController@destroy');
Route::get('dashBoard/productos/{producto}/edit','productosController@edit');
Route::get('buscarProducto/{id}','productosController@buscarProducto');

Route::get('buscarProductoSupervisor','productosController@buscarProductoSupervisor');
//Hacer pregunta
Route::get('Categorias/{id}/preguntar','productosController@preguntar');
Route::post('Categorias/{id}/EnviarPregunta','productosController@enviarPregunta');

Route::get('Productos/{id}/{producto_id}/enviarRespuesta','productosController@enviarRespuesta');
Route::get('Productos/{id}/responder','productosController@responder');
Route::get('productos/comprar/{id}','productosController@comprar');

//Route::get('/consignar','productosController@consignar')->name('consignar');

/*categorias */
Route::get('VerCategorias','CategoriasController@verCategorias');
Route::get('productosByCategorias/{categoria}','CategoriasController@ProductoByCategoria');


Route::resource('Categorias','CategoriasController');

Route::get('showHistory/{id}','UsuariosController@showHistory');
Route::resource('Usuarios', 'UsuariosController');
Route::get('historialUsuarios','UsuariosController@historial');
Route::resource('Clientes', 'ClientesController');
