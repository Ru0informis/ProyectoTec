<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    if(Auth::user()->rol == "Supervisor"){
        $usuarios = DB::table('usuarios')
                ->Where('nombre', '!=', Auth::user()->nombre )
                ->get();
        return view('usuarios.usuarios', compact('usuarios'));
    }else{
        //$usuarios = Usuario::all();
        $usuarios = DB::table('usuarios')
                ->where('rol', '!=', 'Supervisor')
                ->Where('nombre', '!=', Auth::user()->nombre )
                ->get();
        return view('usuarios.usuarios', compact('usuarios'));
       }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request ->all();
        if($request['password'] != $request['password2'])
            return redirect()-> back() ->with('error', 'Las contraseñas no coinciden');
        $imagen = $request -> file('imagen')-> store('public/imagenes');
        $url = Storage::url($imagen);
        $valores['imagen'] = $url;
        $valores['password'] = Hash::make( $valores['password'] );
        $registro = new Usuario();
        $registro -> fill($valores);
        $registro -> save();
        return redirect('/Usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario= Usuario::find($id);
        return view('usuarios.edit', compact('usuario'));
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
        $registro = Usuario::find($id);
        $valores = $request ->all(); //recupero todos los datos del formulario

        if($valores['password'] != $valores['password2'])
            return redirect()-> back() ->with('error', 'Las contraseñas no coinciden');
        if(is_null($valores['password']))
            unset($valores['password']);
        else
            $valores['password'] = Hash::make( $valores['password'] );
        $img = $request -> file('imagen');
        if(!is_null($img) ){
            $imagen = $request -> file('imagen1')-> store('public/imagenes'); //obtengo la imagen del input y la guardi en el storage
            $url_replace = str_replace('storage','public', $registro->imagen); //reemplazo la url para eliminar del storage
            $url_N= Storage::url($imagen); //almaceno la nueva imagen en el storage
            Storage::delete($url_replace);
            $url = Storage::url($imagen);
            $valores['imagen'] = $url;
        }
        $registro ->fill($valores);
        $registro ->save();
        return redirect('/Usuarios')-> with('mensaje','Datos actualizados'); 
    }
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Usuario::destroy($id);
        //return "<script>alert('hola');</script>";
        return redirect('/Usuarios');
    }
    public function historial(){

    }
}
