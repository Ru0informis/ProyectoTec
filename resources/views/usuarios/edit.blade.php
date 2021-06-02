@extends('dashboard')
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
        <li>Usuarios > </li>
        <li class="item_selected">Editar usuario</li>
    </ul>
</div>
@endsection
@section('edit')
@if(session('error'))
<div>
    {{session('error')}}
</div>
@endif
@if(session('mensaje'))
<div>
    {{session('mensaje')}}
</div>
@endif
<style>
form{
    width: 300px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 40px;
    display: flex;
    flex-direction: column;
}
input{
    margin-top: 5px;
}
.btn{
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
</style>
    <form action="/Usuarios/{{$usuario->id}}"" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Nombre: <input type="text" name="nombre" value="{{$usuario->nombre}}">
        Apellido paterno: <input type="text" name="a_paterno" value="{{$usuario->a_paterno}}"> 
        Apellido materno: <input type="text" name="a_materno" value="{{$usuario->a_materno}}"> 
        Correo: <input type="text" name="correo" value="{{$usuario->correo}}">
        <img width="150px" height="150px" src="{{$usuario->imagen}}" alt="">
        Imagen: <input type="file" name="imagen" accept="image/*" >
        @error('imagen') <small>{{$message}}</small> @enderror <br>
        Rol: <select name="rol" id="rol">
            <option >{{$usuario->rol}}</option> 
            <option >Supervisor</option>
            <option >Revisor</option>
            <option >Encargado</option>
            <option >Contador</option>
            <option >Cliente</option>
        </select>
        Password: <input type="password" name="pass1"> 
        Confirmar password: <input type="password" name="pass2"> 
        <input class="btn" type="submit" value="Actualizar">
    </form>
@endsection