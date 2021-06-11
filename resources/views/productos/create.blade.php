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
        <li class="item_selected">Agregar producto</li>
    </ul>
</div>
@endsection
@section('create')
<style>
    .form_create{
        display: flex;
        flex-direction: column;
        margin-right: auto;
        margin-left: auto;
        width: 400px;
    }
    textarea{
        resize: none;
    }
</style>
    <form class="form_create" action="/dashBoard/productos" method="post" enctype="multipart/form-data">
        @csrf
        Producto: <input type="text" name="producto">
        Descripción: <textarea name="descripcion" cols="30" rows="10"></textarea>
        Cantidad: <input type="text" name="cantidad">
        Precio: <input type="text" name="precio"> 
        Imagen: <input type="file" name="imagen">
        Categoría: <select name="categoria">
                    <option value="">Seleccione una opción</option>
                    @foreach ($categorias as $categoria)
                         <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select> 
        Numero de cuenta: <input type="number" name="no_cuenta">
        <input type="submit" value="Crear">
    </form>
@endsection