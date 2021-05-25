@extends('dashBoard')



    <style>
        .table_categories{
         border: 1px solid rgba(255, 255, 255, 0);
         border-spacing: 0;
         margin: auto;

            }
        .link_add{
                background-color: #009CFF;
                text-align: center;
                font-size: 20px;
            }
        .link_add:hover{
                background-color: #006EFF;
            }
        a{
            color: black;
        }
        th{
            background-color: #00FFFF;
        }
        th, td{
            width: max-content;
            text-align: center;
            font-size: 18px;
            border: 1px solid black;
            padding: 5px;
            
        }
        .acciones_links{
            background-color: rgba(255, 255, 255, 0);
            font-size: 18px;
            padding: 2px;
            border: 0;
        }
        .acciones_links:hover{
            background-color:#006EFF ;
        }
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
@section('breadcumb')
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li class="item_selected">Usuarios</li>
    </ul>
</div>
@endsection
@section('usuarios')
   
@if(session('mensaje'))
<div>
    {{session('mensaje')}}
</div>
@endif
<table class="table_categories">
<thead>
<tr class="link_add"><td colspan="8"><a href="/Usuarios/create">Agregar usuario</a></td></tr>
<th>Usuario</th>
<th>Apellido paterno</th>
<th>Apellido materno</th>
<th>Correo</th>
<th>Rol</th>
<th>Activo</th>
<th>Acciones</th>
</thead>
<tbody>
    @forelse($usuarios as $usuario)
        <tr>
            <td>{{$usuario->nombre}}</td>
            <td>{{$usuario->a_paterno}}</td>
            <td>{{$usuario->a_materno}}</td>
            <td>{{$usuario->correo}}</td>
            <td>{{$usuario->rol}}</td>
            <td>{{$usuario->activo}}</td>
            <td>
                <a class="acciones_links" href="/Usuarios/{{$usuario->id}}/edit">Editar</a>
                <a class="acciones_links" href="/Usuarios/{{$usuario->id}}">Mostrar</a>
                <form action="/Usuarios/{{$usuario->id}}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="acciones_links" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
        
        <td colspan="8">sin registros</td>
        </tr>
    @endforelse
</tbody>
</table>

@endsection

