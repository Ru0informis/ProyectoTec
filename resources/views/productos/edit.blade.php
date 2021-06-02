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
        <li class="item_selected">Editar producto</li>
    </ul>
</div>
@endsection
@section('edit')
<style>
    .form_edit{
        margin-left: auto;
        margin-right: auto;
        width: 300px;
        display: flex;
        flex-direction: column;

    }
    textarea{
        padding: 5px;
        resize: none;
    }
    img{
        width: 50%;
        height: 50%;
    }
    input{
        width: 400px;
    }
</style>
<form class="form_edit" action="/dashBoard/productos/{{$producto->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Producto: <input type="text" name="producto" value="{{$producto->producto}}">
        Descripción:<textarea name="descripcion" cols="30" rows="10">{{$producto->descripcion}}</textarea> 
        Precio: <input type="text" name="precio" value="{{$producto->precio}}"> 
        Imagen: <img src="{{$producto->imagen}}" alt=""><input type="file" name="imagen"> 
        <input class="form_edit_input" type="submit" value="enviar">
    </form>

@endsection