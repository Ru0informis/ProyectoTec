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
    form{
        display: flex;
        flex-direction: column;
        width: 353px;
        margin-left: auto;
        margin-right: auto;
    }
    input{
        margin-top: 10px;
    }
    .btnSend{
        width: 60%;
        margin-right: auto;
        margin-left: auto;
        padding: 2px;
        font-size: 18px;
    }
    textarea{
        resize: none;
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
    <form action="/Categorias" method="post" enctype="multipart/form-data">
        @csrf
        Categoria: <input type="text" name="nombre">
        Descripción: <textarea name="descripcion" cols="30" rows="10"></textarea>
        Imagen: <input type="file" name="imagen">
        <input type="submit" value="Crear categoría" class="btnSend">
    </form>
@endsection