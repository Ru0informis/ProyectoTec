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
        <li>Usuarios > </li>
        <li class="item_selected">Ver usuario</li>
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
        <li><label id="lbCategoria">Usuario: {{$usuario->nombre}}</label></li>
        <li><label id="lbCategoria">Apellido paterno: {{$usuario->a_paterno}}</label></li>
        <li><label id="lbCategoria">Apellido Materno: {{$usuario->a_materno}}</label></li>
        <li><label id="lbCategoria">Correo: {{$usuario->correo}}</label></li>
        <li><label id="lbCategoria">Imagen: </label><img width="100px" height="100px" src="{{ asset($usuario->imagen) }}" alt=""></li>
        <li><label id="lbCategoria">Rol: {{$usuario->rol}}</label></li>
        <li><label id="lbCategoria">Activo: {{$usuario->activo}}</label></li>
    </lu>
    
    

@endsection