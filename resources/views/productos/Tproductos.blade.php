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
            text-align: center;
            font-size: 18px;
            width: 25%;
            vertical-align: top;
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
        background-color: rgb(134 132 132 / 95%);
        margin-top: 0;
        margin-bottom: 5px;
    }
    </style>
@section('breadcumb')
<div class="content_bread">
    <ul>
        <li>Inicio > </li>
        <li class="item_selected">Productos</li>
    </ul>
</div>
@endsection
@section('Tproductos')
<form class="form_search" action="/buscarProducto/{{$categoriaId ?? ''}}/">
    Buscar: <input type="text" placeholder="Buscar un producto" name="buscarProducto"> 
    <select name="categoria" id="">
    <option value="">Seleccione una Categoría.</option>
        @foreach($categorias as $categoria)
            <option value="{{$categoria->id}}"> {{$categoria->nombre}} </option>
        @endforeach
    </select>
    <button type="submit"><img src="../static/img/buscar.png" width="20px"></button>
 </form>

<table class="table_categories">
<thead>
@can('create', App\Models\Producto::class)
    <tr class="link_add"><td colspan="4"><a href="/dashBoard/productos/create">Proponer producto</a></td></tr>
@endcan
<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Acciones</th>
</thead>
<tbody>
    @forelse($producto as $producto)
        <tr>
            <td>{{$producto->producto}}</td>
            <td>{{$producto->precio}}</td>
            <td>{{$producto->cantidad}}</td>
            <td>
                @can('update', $producto)
                    <a class="acciones_links" href="/dashBoard/productos/{{$producto->id}}/edit">Editar</a>
                @endcan
                <a class="acciones_links" href="/dashBoard/productos/{{$producto->id}}">Mostrar</a>
                @can('delete', $producto)
                    <form action="/dashBoard/productos/{{$producto->id}}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="acciones_links" type="submit">Eliminar</button>
                    </form>
                @endcan
            </td>
        </tr>
    @empty
        <tr>
        
        <td colspan="4">sin registros</td>
        </tr>
    @endforelse
</tbody>
</table>

@endsection
