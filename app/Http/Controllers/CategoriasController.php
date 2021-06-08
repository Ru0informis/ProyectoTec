<?php

namespace App\Http\Controllers;
//use App\Models\Producto::scopeProductosConcesionados()-> get();
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\VarDumper;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.listCategories', compact('categorias'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria ->nombre = $request->input('nombre');
        $categoria ->descripcion = $request->input('descripcion');
        $imagen = $request -> file('imagen')-> store('public/imagenes/categorias');
        $url = Storage::url($imagen);
        $categoria ->imagen = $url;
        $categoria ->activa = 0;
        $categoria ->save();
        return redirect('Categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = DB::table('productos')
                        ->where('concesionado','=',1)
                        ->where('categoria_id',$id)->get();
        $categoriaId = $id;
        

        //$productos = Producto::scopeProductosConcesionados();
        //echo $productos;

        return view('categorias.show', compact('productos',"categoriaId"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria= Categoria::find($id);
        return view('categorias.edit', compact('categoria'));
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
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        //$categoria->imagen = "";
        $categoria->activa = 1;
        $categoria->save();
        //$seccion = $request->input('seccion');
        //Categoria::editar($id, $seccion);
        return redirect('Categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categoria::destroy($id);
        //return "<script>alert('hola');</script>";
        return redirect('Categorias');
    }
    public function ProductoByCategoria($id){
      
        $productos = DB::table('productos')
                        ->where('concesionado','=',1)
                        ->where('categoria_id',$id)->get();
        $categoriaId = $id;
        

        //$productos = Producto::scopeProductosConcesionados();
        //echo $productos;

        return view('anonimo.verProductoCategoria', compact('productos',"categoriaId"));
        
    }
    public function verCategorias(){
        $categorias = Categoria::all();
        return view('anonimo.listCategories', compact('categorias'));
        
    }
}
