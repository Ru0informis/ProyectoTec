@extends('dashBoard')

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
li{
        list-style: none;
    }
    ul{
        display: flex;
        padding: 5px;
        font-size: 18px;
    }
    .item_selected{
        color: rgb(255, 255, 255);
    }
    .content_bread{
        background-color: rgba(7, 7, 7, 0.39);
        margin-top: 0;
        margin-bottom: 5px;
    }
</style>
@if(session('error'))
<div>
    {{session('error')}}
</div>
@endif
@section('breadcumb')
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li class="item_selected"> Actualizar mis datos</li>
    </ul>
</div>
@endsection
@section('edit')
<form class="form_edit" action="/Clientes/{{Auth::user()-> id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Nombre: <input type="text" name="nombre" value="{{Auth::user()->nombre}}">
        Apellido paterno: <input type="text" name="a_paterno" value="{{Auth::user()->a_paterno}}"> 
        apellido materno: <input type="text" name="a_materno" value="{{Auth::user()->a_materno}}"> 
        Correo: <input type="text" name="correo" value="{{Auth::user()->correo}}">
        Imagen:<img width="100px" height="100px" src="{{ asset(Auth::user()->imagen) }}"> <input type="file" name="imagen1" accept="image/*">
        @error('imagen') <small>{{$message}}</small> @enderror <br>
        Password: <input type="password" name="password"> 
        Confirmar password: <input type="password" name="password2"> 
        <input class="btn" type="submit" value="Actualizar">
    </form>

@endsection