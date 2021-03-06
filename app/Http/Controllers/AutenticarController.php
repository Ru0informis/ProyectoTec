<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AutenticarController extends Controller
{
    public function validar(Request $request){
        $nombre = $request -> input('name');
        $password = $request ->input('pass');
        $usuario = Usuario::where('nombre', $nombre)->get();
    
           if($size = sizeof($usuario)==0){
            return redirect('/autenticar') ->with('error','El usuario ingresado no existe');
           }else{
            foreach ($usuario as $user){
                if(Hash::check($password, $user->password) & $user->rol =="Supervisor"){
                    Auth::login($user);
                    $usuarios = Usuario::all();
                    $productos = Producto::all();
                    $categorias = Categoria::all();
                    return view('estadisticas', compact('usuarios', 'categorias', 'productos'));
                    
                }elseif(Hash::check($password, $user->password) & $user->rol == "Cliente"){
                    Auth::login($user);
                    return redirect('/');
                }elseif(Hash::check($password, $user->password) & $user->rol == "Encargado"){
                    Auth::login($user);
                    return redirect('/');
                }elseif(Hash::check($password, $user->password) & $user->rol == "Contador"){
                    Auth::login($user);
                    return redirect('/');
                }else{
                    return redirect('/autenticar') ->with('error','Datos incorrectos!');
                }
                    
            }
           }
            //return redirect('/autenticar') ->with('error','Datos incorrectos!');

        
    }
    public function validarEmail(Request $request){
        $email = $request['email'];
        $emailRegistrado = DB::table('usuarios')
                        ->select('correo')
                        ->where('correo','=',$email)->get();
        if(count($emailRegistrado) >= 1)
            return json_encode('El email ingresado ya existe');
        else
            return json_encode('Email ingresado disponible');

        
    }

    public function registrar()
    {
        return view('anonimo.registro');
    }
    public function agregar(Request $request){
        $valores = $request ->all();
        if($request['password'] != $request['password2'])
            return redirect()-> back() ->with('error', 'Las contrase??as no coinciden');
        $request ->validate([
            'imagen' => 'required|image'
        ]);
        $valores['rol']="Cliente";
        $valores['activo']="1";
        $imagen = $request -> file('imagen')-> store('public/imagenes');
        $url = Storage::url($imagen);
        $valores['imagen'] = $url;
        $valores['password'] = Hash::make( $valores['password'] );
        $registro = new Usuario();
        $registro -> fill($valores);
        $registro -> save();
        return redirect('/registrar')-> with('mensaje','Registro exitoso');
    }
    public function autenticar(){
        return view('login');
    }
    public function salir(){
        Auth::logout();
        return redirect('/');
    }
    public function recuperarContrase??a(){
        return view('anonimo.resetPassword');
    }
    public function actualizarContrase??a(Request $request)
    {
        $password = $request->input('pass');
        $email = $request->input('email');
        $nombre = $request -> input('name');
        $usuario = Usuario::where('nombre', $nombre)->get();

        if($size = sizeof($usuario)==0){
            return redirect('/restorePassword') ->with('error','El correo ingresado no existe');
           }else{
            foreach ($usuario as $user){
                if($user->nombre == $nombre & $user->correo == $email ){
                    //$updatePassword = Usuario::find($user->corre);
                    //$newPassword = Hash::make($password);
                    //$updatePassword->password=Hash::make($request->input('pass'));
                    $user->password=Hash::make($request->input('pass'));
                    $user->save();
                    return redirect('/restorePassword') ->with('message','Contrase??a actualizada');
                    
                }else{
                    
                    return redirect('/restorePassword') ->with('error','El correo ingresado no existe');
                }
            }
           }

        
    }
}
