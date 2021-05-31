<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class productosController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user() -> rol == "Cliente")
            $producto = Producto::where('usuario_id', Auth::id())->get();
       else
            $producto = Producto::all();
        return view('productos.Tproductos', compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        
        $this -> authorize('create', App\Models\Producto::class);
       // return view('productos.create', compact('categorias'));
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario_id = Auth::user() -> id;
        $valores = $request ->all();
        $categoria_id =(int)$request['categoria'];
        $request ->validate([
            'imagen' => 'required|image'
        ]);
        $imagen = $request -> file('imagen')-> store('public/imagenes');
        $url = Storage::url($imagen);
        $valores['imagen'] = $url;
        $valores['usuario_id'] = $usuario_id;
        $valores['categoria_id'] = $categoria_id;
        $registro = new Producto();
        $registro -> fill($valores);
        //var_dump($valores['categoria']);
        $registro -> save();
        return redirect('/dashBoard/productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $producto= Producto::find($id);
        $this -> authorize('create', $producto);
        return view('productos.edit', compact('producto'));
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
        $registro = Producto::find($id);
        $valores = $request ->all(); //recupero todos los datos del formulario
        $img = $request -> file('imagen');
        if(!is_null($img) ){
            $imagen = $request -> file('imagen')-> store('public/imagenes'); //obtengo la imagen del input y la guardi en el storage
            $url_replace = str_replace('storage','public', $registro->imagen); //reemplazo la url para eliminar del storage
            $url_N= Storage::url($imagen); //almaceno la nueva imagen en el storage
            Storage::delete($url_replace);
            $url = Storage::url($imagen);
            $valores['imagen'] = $url;
        }
        $registro ->fill($valores);
        $registro ->save();
        return redirect('/dashBoard/productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        //return "<script>alert('hola');</script>";
        return redirect('/dashBoard/productos');
    }
    public function buscarProducto($id,Request $request){
        $buscarProducto = $request->input('buscarProducto');
        $busqueda = DB::table('productos')
                    ->where('producto',$buscarProducto)->get();
        return view('resultadoBusqueda', compact('busqueda'));
    }
}
