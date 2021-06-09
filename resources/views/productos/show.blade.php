@extends('dashBoard')
@section('breadcumb')
<style>
    li{
        list-style: none;
    }
    ul{
        display: flex;
        padding: 5px
    }
    .item_selected{
        color: rgb(255, 255, 255);
        font-size: 18px;
       
    }
    .content_bread{
        background-color: rgb(134 132 132 / 95%);
        margin-top: 0;
        margin-bottom: 5px;
    }
</style>
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li>Productos > </li>
        <li class="item_selected">Ver producto</li>
    </ul>
</div>
@endsection
@section('show')
<style>
    #lbCategoria{
        color: black;
    }
    #lu_c{
        list-style: none
    }
</style>

    <lu id="lu_c">
        <img src="{{$producto->imagen}}" width="15%">
        <li><label id="lbCategoria">Producto: {{$producto->producto}}</label></li>
        <li><label id="lbCategoria">Cantidad: {{$producto->cantidad}}</label></li>
        <li><label id="lbCategoria">Precio: {{$producto->precio}}</label></li>
        @if($producto->concesionado==1)
            <li><label id="lbCategoria">Estado: Aceptado</label></li>
        @else
            <li><label id="lbCategoria">Estado: Pendiente</label></li>
            @if($producto->motivo!=null)
                <li><label id="lbCategoria">Motivo: {{$producto->motivo}}</label></li>
            
            @endif
        @endif
        

    </lu>
    
    

@endsection