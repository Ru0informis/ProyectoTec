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
        background-color: rgba(7, 7, 7, 0.39);
        margin-top: 0;
        margin-bottom: 5px;
    }
</style>
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li>Categorías > </li>
        <li class="item_selected">Crear categoría</li>
    </ul>
</div>
@endsection
@section('create')
    <form action="/dashBoard" method="post">
        @csrf
        Categoria: <input type="text" name="nombre">
        Descripción: <input type="text" name="descripcion"> 
        <input type="submit" value="enviar">
    </form>
@endsection