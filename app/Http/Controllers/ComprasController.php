<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //aqui se listan todos los pagos por validar
        $compras= DB::select('SELECT DISTINCT compras.id, (SELECT nombre FROM usuarios WHERE usuarios.id=compras.vendedor_id) AS "Vendedor", (SELECT nombre FROM usuarios WHERE usuarios.id=compras.comprador_id)AS "Comprador", (SELECT producto FROM productos WHERE productos.id=compras.producto_id) AS "producto" , compras.cantidad, compras.Total, compras.fecha_compra, compras.estado, compras.calificacion, compras.comprobante FROM compras INNER JOIN usuarios on compras.comprador_id = usuarios.id WHERE compras.estado=0');
        return view('compras.compras', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui para crear un pago a un vendedor.
       $pagosP =DB::select('SELECT id AS "compra_id", (SELECT id FROM usuarios  WHERE pagos.vendedor_id = usuarios.id) AS "id_vendedor", (SELECT nombre FROM usuarios  WHERE pagos.vendedor_id = usuarios.id) AS "vendedor", estado_pago FROM pagos WHERE estado_pago = 0');
        return view('compras.create', compact('pagosP'));
        //return $pagosP;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $pago = DB::select('SELECT (SELECT producto FROM productos WHERE compras.producto_id = productos.id) AS "producto", (SELECT id FROM usuarios WHERE usuarios.id = compras.vendedor_id) AS "vendedor_id",(SELECT nombre FROM usuarios WHERE usuarios.id = compras.vendedor_id) AS "vendedor",fecha_compra, Total, cantidad, (SELECT SUM(Total) FROM compras) AS "total_pagar" FROM compras WHERE compras.vendedor_id = '.$id.' ');
       return response(json_encode($pago), 200)->header('Content-type','text/plain');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $monto =$request['monto'];
        $pago = DB::select('UPDATE pagos SET monto= '.$monto.', estado_pago= 1 WHERE vendedor_id='.$id.'');
        $message =['message'=>'Pago registrado exitosamente'];
        return response(json_encode($message), 200)->header('Content-type','text/plain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function pagos(){
        //aqui se enlistan todos los pagos
        $pagos =DB::select('SELECT id, (SELECT nombre FROM usuarios  WHERE pagos.vendedor_id = usuarios.id) AS "vendedor",notas, monto, fecha_pago FROM pagos');
        return view('compras.pagos', compact('pagos'));
    }
    public function validar(Request $request){
    
    $id = $request['id'];
       //$id=1;
        $venta= $venta= DB::select('SELECT DISTINCT compras.id , (SELECT nombre FROM usuarios WHERE usuarios.id=compras.vendedor_id) AS "Vendedor", (SELECT nombre FROM usuarios WHERE usuarios.id=compras.comprador_id)AS "Comprador", (SELECT producto FROM productos WHERE productos.id=compras.producto_id) AS "producto" , compras.cantidad, compras.Total, compras.fecha_compra, compras.estado, compras.calificacion, compras.comprobante FROM compras INNER JOIN usuarios on compras.comprador_id = usuarios.id WHERE compras.id = '.$id.'');
        //return view('compras.pagos', compact('pagos'));
        //var_dump($id);
        return response(json_encode($venta), 200)->header('Content-type','text/plain');
    }
    public function aceptar(Request $request){
        $compra = Compra::find($request['id']);
        
        
        
        if($request['motivo'] != null){
            $compra->motivo=$request['motivo'];
            $compra->save();
            $message =['message'=>'El deposito fue rechazado, el motivo fue registrado existosamente'];
            return response(json_encode($message), 200)->header('Content-type','text/plain');
        }else{
            $compra->estado=$request['estado'];
            $compra->save();
            $message =['message'=>'Compra validada'];
            return response(json_encode($message), 200)->header('Content-type','text/plain');
        }
        
    }
}
