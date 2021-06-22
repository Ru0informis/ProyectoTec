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
    <div>
            @if (session('mensaje'))
                <b>{{session('mensaje')}}</b>
            @endif
    </div>
@foreach ($compra as $compra)
    
    <div class="compras_content">
        <div>
            <b>Vendedor:</b><label class="lb_compra"> {{$compra->Vendedor}} </label>
            <b>Comprador:</b><label class="lb_compra"> {{$compra->Comprador}} </label>
        </div>
        <div>
            <b>Producto:</b><label class="lb_compra"> {{$compra->producto}} </label>
            <b>Cantidad:</b><label class="lb_compra"> {{$compra->cantidad}} </label>
            <b>Total a pagar:</b><label class="lb_compra"> ${{$compra->Total}} </label>
        </div>
        <b>Fecha de compra:</b><label class="lb_compra"> {{$compra->fecha_compra}} </label>
        @if ($compra->comprobante == null)
            @if ($compra->estado == 0)
                <b>Estado de la compra</b><label class="lb_compra">Pendiente</label>
            @endif
            <!-- <a href="/dashBoard/productos/compras/">comprobante de pago</a>-->
            <b> <small>suba aqui su voucher o ticket de deposito y espere a que su pago sea validado.</small> </b>
            <form action="/dashBoard/productos/compras/{{$compra->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="imagen"><br>
                <input type="submit" value="Enviar">
            </form>
        @else
            @if (is_null($compra->calificacion)  & $compra->estado ==1)
            <form action="/dashBoard/productos/compras/{{$compra->id}}/calificar" method="post">
                    @csrf
                    Califique su compra:
                    <select name="calificacion" id="">
                        <option>Seleccione una opción</option>
                        <option>Excelente</option>
                        <option>Muy bueno</option>
                        <option>Bueno</option>
                        <option>Regular</option>
                        <option>Malo</option>
                    </select><br>
                    <input type="submit" value="Calificar">
                </form>
                
            @else
            @if ($compra->estado == 1)
            <b>Estado de la compra</b><label class="lb_compra">Entregada</label>
            <div> Usted ha calificado esta compra como <b>{{ $compra->calificacion  }}</b></div>
            @endif
                
                
            @endif
        @endif
        
       
    </div>
@endforeach
</div>
@endsection
