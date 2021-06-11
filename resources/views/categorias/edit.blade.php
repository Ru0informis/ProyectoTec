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
        <li class="item_selected">Editar categoría</li>
    </ul>
</div>
@endsection
@section('edit')
<style>
    .form_edit_input{
        height: 25px;
    }
    textarea{
        width: 250px;
        height: 100px;
        padding: 5px;
    }
</style>
<form class="form_edit" action="/Categorias/{{$categoria->id}}" method="post"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Categoria: <input class="form_edit_input" type="text" name="nombre" value="{{$categoria->nombre}}"> <br><br>
        Descripcion: <textarea name="descripcion" value="{{$categoria->descripcion}}"> {{$categoria->descripcion}}</textarea>
        imagen: <input type="file" name="imagen" value="{{$categoria->imagen}}"> <br><br>
        <input class="form_edit_input" type="submit" value="enviar">
    </form>

@endsection