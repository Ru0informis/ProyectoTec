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
        <li class="item_selected">Crear usuario</li>
    </ul>
</div>
@endsection
@section('create')
@if(session('error'))
<div>
    {{session('error')}}
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
    <form action="/Usuarios" method="post" enctype="multipart/form-data">
        @csrf
        Nombre: <input type="text" name="nombre">
        Apellido paterno: <input type="text" name="a_paterno"> 
        apellido materno: <input type="text" name="a_materno"> 
        Correo: <input type="text" name="correo">
        Imagen: <input type="file" name="imagen" accept="image/*">
        @error('imagen') <small>{{$message}}</small> @enderror <br>
        Rol: <select name="rol"> 
            <option >Supervisor</option>
            <option >Revisor</option>
            <option >Encargado</option>
            <option >Contador</option>
            <option >Cliente</option>
        </select>
        Activo: <input type="text" name="activo">
        Password: <input type="password" name="password"> 
        Confirmar password: <input type="password" name="password2"> 
        <input class="btn" type="submit" value="Agregar">
    </form>
@endsection