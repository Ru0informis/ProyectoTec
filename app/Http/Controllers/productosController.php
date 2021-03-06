<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Compra;

use App\Mail\MensajeRecieved;
use App\Models\Pago;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;

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
            $categorias = Categoria::all();
        return view('productos.Tproductos', compact('producto', 'categorias'));
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
        $valores['concesionado'] = 0;
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

    public function buscarProducto(Request $request, $id){
        //buscarproductos usuario anonimo
        $buscarProducto = $request->input('buscarProducto');
       
        
       if(is_null(Auth::user())){
        $busqueda = DB::table('productos')
        ->where('concesionado','=',1)
        ->where('categoria_id','=',$id)
        ->where('producto','LIKE', '%'.$buscarProducto.'%')->get();
        return view('anonimo.resultadoBusqueda', compact('busqueda'));
       }else{
        $busqueda = DB::table('productos')
        ->where('concesionado','=',1)
        ->where('categoria_id','=',$id)
        ->where('producto','LIKE', '%'.$buscarProducto.'%')
        ->where('usuario_id','!=',Auth::user()->id)->get();
        return view('categorias.resultadoBusqueda', compact('busqueda'));
       }
    }

    

    public function buscarProductoSupervisor(Request $request){
       
        $buscarProducto= $request->all();
       if(Auth::user()->rol=='Cliente'){
            $busqueda2 = DB::table('productos')
            ->where('producto', 'LIKE', '%'.$buscarProducto['buscarProducto'].'%')
            ->where('categoria_id',$buscarProducto['categoria'])
            ->where('usuario_id','=',Auth::user()->id)->get();
            return view('resultadoBusquedaSupervisor', compact('busqueda2'));
       }elseif(Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado'){
            $busqueda2 = DB::table('productos')
            ->where('producto', 'LIKE', '%'.$buscarProducto['buscarProducto'].'%')
            ->where('categoria_id',$buscarProducto['categoria'])->get();
            return view('resultadoBusquedaSupervisor', compact('busqueda2'));
       }
        
    }
    public function concesionarView($id){
        $producto = Producto::find($id);
        return view('concesionar',compact('producto'));
    }
    public function concesionarProducto($id, Request $request){
        $productoAConsignar = Producto::find($id);
        $respuesta = $request ->all();
        if($respuesta['respuesta'] == "si" || $respuesta['respuesta'] == "SI" ){
            $respuesta['respuesta'] = 1;
            $productoAConsignar->concesionado = $respuesta['respuesta'];
            $productoAConsignar ->save();
            return redirect('/dashBoard/productos');
        }else{
            $respuesta['respuesta'] = 0;
            $productoAConsignar->concesionado = $respuesta['respuesta'];
            $productoAConsignar->motivo = $respuesta['motivo'];
            $productoAConsignar ->save();
            return redirect('/dashBoard/productos');
        }
        
    }

    public function preguntar($id){
        //funcion para retornar la vista donde se realiza la pregunta
        $producto = Producto::find($id);
        $preguntas = DB::table('preguntas')
                    ->where('usuario_id','=',Auth::user()->id)
                    ->where('producto_id','=', $id)->get();
        return view('categorias.eviarPregunta', compact('producto','preguntas'));
    }

    public function responder($producto_id){
        
        //funcion para retornar la vista donde se realiza la pregunta
        if(Auth::user()->rol=='Cliente'){
            $preguntas= DB::table('usuarios')
                ->select('usuarios.id','usuarios.nombre','preguntas.pregunta','preguntas.id as pregunta_id','preguntas.respuesta')
                ->join('preguntas','usuarios.id','=','preguntas.usuario_id',)
                ->whereNull('preguntas.respuesta')
                ->where('producto_id','=', $producto_id)->get();
            return view('categorias.responderPregunta', compact('preguntas','producto_id'));
        }
        elseif(Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado'){
            $preguntas= DB::table('usuarios')
                    ->select('usuarios.id','usuarios.nombre','preguntas.pregunta','preguntas.id as pregunta_id','preguntas.respuesta')
                    ->join('preguntas','usuarios.id','=','preguntas.usuario_id',)
                    ->where('producto_id','=', $producto_id)->get();
            return view('categorias.responderPregunta', compact('preguntas','producto_id'));
        }
       
    }
    public function enviarRespuesta($id,$producto_id, Request $request){
        $respuesta = Pregunta::find($id);
        $respuesta->respuesta= $request->input('respuesta');
        $respuesta -> save();
        return redirect('/Productos/'.$producto_id.'/responder')-> with('mensaje','Respuesta enviada');  
        
    }
    
    public function enviarPregunta(Request $request, $id){
        //funcion para guardar la pregunta
        $pregunta=new Pregunta();
        $enviar=$request->all();
        $enviar['id_producto'] = $id;
        $enviar['id_usuario'] = Auth::user()->id;
        $pregunta->producto_id=$enviar['id_producto'];
        $pregunta->pregunta=$enviar['pregunta'];
        $pregunta->usuario_id=$enviar['id_usuario'];
        $pregunta->save();
        return redirect('/Categorias/'.$id.'/preguntar')-> with('mensaje','Pregunta enviada');  
    }

    public function comprar($id){
        $producto = Producto::find($id);
        return view('clientes.compra',compact('producto'));
        
    }

    public function realizarcompra(Request $request, $producto_id, $cantidad){
        //aqui el metodo para registrar una compra
        var_dump($cantidad); echo "<br>";
        var_dump($request->all());
        
        $producto= Producto::find($producto_id);
        $vendedorid= $producto-> usuario_id;
        $enviar= $request-> all();
        $compradorid= Auth::user()->id;
        $pr= $enviar['p'];
        $cant= $enviar['cantidadP'];
        $total= $cant * $pr;
        $pregunta= new Compra();
        $pregunta-> comprador_id= $compradorid ;
        $pregunta-> producto_id= $producto_id ;
        $pregunta-> vendedor_id= $vendedorid ;
        $pregunta-> cantidad= $cant;
        $pregunta-> Total= $total ;
        $pregunta->save();
        $producto-> cantidad = $producto-> cantidad- $cant;
        $producto ->save(); 
        $emailvend= Usuario::find($vendedorid);
        $correo = new MensajeRecieved;
        Mail::to($emailvend -> correo)-> send($correo);
        $pago = new Pago();
        $pago->vendedor_id = $vendedorid;
        $pago->save();
        return redirect('/productos/comprar/'.$producto_id.'/')-> with('mensaje','compra registrada, revisar seccion productos/productos comprados, para subir el comprobante de pago ');
    }
    public function compras(){  
        //metodo para ver las compras de un usuario x
        $usuario_id = Auth::user()->id;
        $compra= DB::select('SELECT DISTINCT compras.id, (SELECT nombre FROM usuarios WHERE usuarios.id=compras.vendedor_id) AS "Vendedor", (SELECT nombre FROM usuarios WHERE usuarios.id=compras.comprador_id)AS "Comprador", (SELECT producto FROM productos WHERE productos.id=compras.producto_id) AS "producto" , compras.cantidad, compras.Total, compras.fecha_compra, compras.estado, compras.calificacion, compras.comprobante FROM compras INNER JOIN usuarios on compras.comprador_id = '.$usuario_id.'');
        return view('clientes.showCompras',compact('compra'));
    }
    public function kardex($id){
        $producto = Producto::find($id);
        $historialProducto = DB::select('SELECT DISTINCT preguntas.producto_id, preguntas.pregunta, preguntas.respuesta, usuarios.nombre AS "comprador", (SELECT nombre FROM usuarios WHERE usuarios.id=productos.usuario_id)AS "vendedor" FROM usuarios INNER JOIN preguntas ON preguntas.usuario_id=usuarios.id INNER JOIN productos on '.$id.'=preguntas.producto_id');
        $historialProductoCompra = DB::select('SELECT fecha_compra, (SELECT nombre FROM usuarios WHERE compras.comprador_id=usuarios.id) AS "comprador" , (SELECT nombre FROM usuarios WHERE compras.vendedor_id=usuarios.id) AS "vendedor", cantidad, Total FROM compras WHERE compras.producto_id = '.$id.' AND estado="0"');

        return view('productos.kardex', compact('historialProducto', 'historialProductoCompra','producto'));
    }

    public function confirmarComp($id){
return view('recibo', compact('id'));
    }

    public function a??adirComp(Request $request, $id){
        $registro = Compra::find($id);
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
        $registro ->comprobante= $valores['imagen'];
        $registro ->save();
        return redirect('/dashBoard/productos/compras')-> with('mensaje','Comprobante enviado');
        
    }
    public function calificar(Request $request, $id){
            $registro = Compra::find($id);
            $valores= $request->all();
            $registro ->calificacion= $valores['calificacion'];
            $registro ->save();
            return redirect('/dashBoard/productos/compras')-> with('mensaje','gracias por su calificaci??n.');
        
    }

    
}
