@extends('general')

@section('registro')
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
        <form action="/agregar" method="post" enctype="multipart/form-data">
            @csrf
            Nombre: <input type="text" name="nombre">
            Apellido paterno: <input type="text" name="a_paterno"> 
            Apellido materno: <input type="text" name="a_materno"> 
            Correo: <input type="text" name="correo">
            Imagen: <input type="file" name="imagen" accept="image/*">
            @error('imagen') <small>{{$message}}</small> @enderror <br>
            Password: <input type="password" name="password"> 
            Confirmar password: <input type="password" name="password2"> 
            <input class="btn" type="submit" value="Agregar">
        </form>
@endsection