@extends('dashBoard')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
</head>
<body>
    <style>
        .table_categories{
         border: 1px solid rgba(255, 255, 255, 0);
         border-spacing: 0;
         margin: auto;
         text-align: center;

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
            text-align: center;
            font-size: 18px;
            width: min-content;
            vertical-align: center;
            border: 1px solid black;
            padding: 2px;
            
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
    .imgC{
        width: 30%;
    }
    </style>
@section('categoria')
@section('breadcumb')
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li class="item_selected">Categorías</li>
    </ul>
</div>
@endsection

<table class="table_categories">
<thead>
@can('create', App\Models\Categoria::class)
    <tr class="link_add"><td colspan="3"><a href="/dashBoard/create">Agregar categoria</a></td></tr>
@endcan
<th>Nombre</th>
<th>CantidadProductos</th>
<th>Acciones</th>
</thead>
<tbody>
    @forelse($categorias as $categoria)
        <tr>
            <td><img class="imgC" src="{{$categoria->imagen}}" alt=""></td>
            <td>{{$categoria->nombre}}</td>
        <td>
        @can('create', $categoria)
        <a class="acciones_links" href="/dashBoard/{{$categoria->id}}/edit">Editar</a>
        @endcan
        <a class="acciones_links" href="/dashBoard/{{$categoria->id}}">Mostrar</a>
        @can('create', $categoria)
            <form action="/dashBoard/{{$categoria->id}}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="acciones_links" type="submit">Eliminar</button>
            </form>
        @endcan
        
        </td>
        </tr>
    @empty
        <tr>
        <td colspan="3">sin registros</td>
        </tr>
    @endforelse
</tbody>
</table>

@endsection
</body>
</html>
