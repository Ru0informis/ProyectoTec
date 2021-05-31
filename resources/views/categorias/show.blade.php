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
        <li>Categorías > </li>
        <li class="item_selected">Ver categoría</li>
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
        <li><label id="lbCategoria">Categoría: {{$seccion->nombre}}</label></li>
        <li><label id="lbCategoria">Descripción: {{$seccion->descripcion}}</label></li>
        <li><label id="lbCategoria">Estado: {{$seccion->estado}}</label></li>
    </lu>
    
    

@endsection