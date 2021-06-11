@extends('dashBoard')

@section('kardex')
<style>
    .producto_info, .productos_historial, .producto_compras{
        padding: 5px;
    }
</style>
<img src="{{ $producto->imagen }}" width="15%"> <br>
<div class="producto_info">
Producto: {{$producto->producto}} <br>
Existencia: {{$producto->cantidad}} <br>
Fecha de registro: ---- <br>
<b>Preguntas hechas: {{$size = sizeof($historialProducto)}}</b>
</div>
    @foreach ($historialProducto as $historial)
        <div class="productos_historial">
            El usuario <b>{{$historial->comprador}}</b> preguntó: <b>{{$historial->pregunta}}</b> <br>
            El vendedor <b>{{$historial->vendedor}}</b> respondió: <b>{{$historial->respuesta}}</b> <br>
        <hr>
        </div>
    @endforeach
<b>Compras registradas: {{$size = sizeof($historialProductoCompra)}}</b>
    @foreach ($historialProductoCompra as $historialCompra )
        <div class="producto_compras">
        <b>Fecha de compra: </b>{{$historialCompra->fecha_compra}} <br>
        <b>Comprador: </b>{{$historialCompra->comprador}} <br>
        <b>Vendedor : </b>{{$historialCompra->vendedor}} <br>
        <b>Cantidad: </b>{{$historialCompra->cantidad}} <br>
        <b>Total: $ </b>{{$historialCompra->Total}} <br>
        <hr>
    </div>    
    <br>
    @endforeach
@endsection