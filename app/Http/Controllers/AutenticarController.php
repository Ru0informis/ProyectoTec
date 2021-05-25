<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AutenticarController extends Controller
{
    public function validar(Request $request){
        $nombre = $request -> input('name');
        $usuario = Usuario::where('nombre', $nombre)->first();
        if(is_null($usuario))
            return redirect('/autenticar') ->with('error','Usuario no registrado');
        else{
            $password = $request ->input('pass');
            $password_bd = $usuario->password; 
            $rol = $usuario->rol;
            if(Hash::check($password, $password_bd) & $rol =="Supervisor"){
                Auth::login($usuario);
                return redirect('/');
            }elseif(Hash::check($password, $password_bd) & $rol =="Cliente"){
                Auth::login($usuario);
                return redirect('/');

            }elseif(Hash::check($password, $password_bd) & $rol =="Revisor"){
                Auth::login($usuario);
                return redirect('/');

            }
            return redirect('/autenticar') ->with('error','Usuario no registrado');
        }
    }
    public function registrar()
    {
        return view('registro');
    }
    public function agregar(Request $request){
        $valores = $request ->all();
        if($request['password'] != $request['password2'])
            return redirect()-> back() ->with('error', 'Las contraseñas no coinciden');
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
        return redirect('/index');
    }
}
