@extends('dashBoard')
@section('shomCompras')
<style>
    .lb_compra{
        color: black;
        font-size: 18px;
    }
    .compras{
        display: flex;
        flex-direction: column;
        padding: 5px;
    }
    .compras_content{
        display: flex;
        flex-direction: column;
        border: 1px solid black;
        padding: 10px;
    }
</style>
<div class="compras">
    @foreach ($compra as $compra)
    <div class="compras_content">
            <b>Vendedor:</b><label class="lb_compra"> {{$compra->Vendedor}} </label>
        <b>Comprador:</b><label class="lb_compra"> {{$compra->Comprador}} </label>
        <b>Producto:</b><label class="lb_compra"> {{$compra->producto}} </label>
        <b>Cantidad:</b><label class="lb_compra"> {{$compra->cantidad}} </label>
        <b>Total a pagar:</b><label class="lb_compra"> {{$compra->Total}} </label>
        <b>Fecha de compra:</b><label class="lb_compra"> {{$compra->fecha_compra}} </label>
        @if ($compra->estado==0)
            <b>Estado de la compra:</b><label class="lb_compra">Pendiente</label>
            <a href="/dashBoard/productos/compras/{{$compra->id}}">comprobante de pago</a>
        @else
        <b>Estado de la compra</b><label class="lb_compra">Compra realizada</label>
        @endif
    </div>
@endforeach
</div>


@endsection