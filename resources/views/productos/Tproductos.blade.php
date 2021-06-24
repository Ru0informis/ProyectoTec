@extends('dashBoard')
    <style>
        .table_categories{
        
         border-spacing: 0;
         width: 100%;

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
        th{
            text-align: center;
            font-size: 18px;
            width: min-content;
            vertical-align: top;
            padding: 5px;
            
        }
        td{
            text-align: center;
            font-size: 18px;
            vertical-align: top;
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
    #listC{
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
    
    .items:hover{
        background-color: #006EFF;
        cursor: pointer;
    }
    .item_concesionado{
        background-color: #009CFF;
    }
    </style>
@section('breadcumb')
<div class="content_bread">
    <ul id="listC">
        <li>Inicio > </li>
        <li class="item_selected">Productos</li>
    </ul>
</div>
@endsection
@section('Tproductos')
<form class="" action="/buscarProductoSupervisor"> 
    <select name="categoria" id="">
    <option value="">Seleccione Categoría.</option>
        @foreach($categorias as $categoria)
            <option value="{{$categoria->id}}"> {{$categoria->nombre}} </option>
        @endforeach
    </select>
    <input type="text" placeholder="Buscar un producto" name="buscarProducto"> 
    <button type="submit"><img src="../static/img/buscar.png" width="20px"></button>
 </form>

<table class="table_categories">
<thead>
@can('create', App\Models\Producto::class)
    <tr class="link_add"><td colspan="5"><a href="/dashBoard/productos/create">Proponer producto</a></td></tr>
@endcan
<th>Producto</th>
<th>Precio</th>
<th style="width: 10px">Cantidad</th>
<th>Categoria</th>
<th>Acciones</th>
</thead>
<tbody>
    @forelse($producto as $producto)
        <tr class="items">
            <!--if para verificar si esta o no concesionado, si no lo esta pintara la fila de otro color -->
            @if ($producto->concesionado == 0)
                <td class="item_concesionado">{{$producto->producto}}</td>
                <td class="item_concesionado">{{$producto->precio}}</td>
                <td class="item_concesionado">{{$producto->cantidad}}</td>
                <td class="item_concesionado">{{$producto->categoria_id}}</td>
                <td class="item_concesionado">
                    @can('update', $producto)


                        <a class="acciones_links" href="/dashBoard/productos/{{$producto->id}}/edit">Editar</a>
                    @endcan
                    <a class="acciones_links" href="/dashBoard/productos/{{$producto->id}}">Mostrar</a>
                    @can('concesionar', $producto)
                    <a class="acciones_links" href="/dashBoard/productos/concesionar/{{$producto->id}}">Concesionar</a>
                    @endcan
                    @can('delete', $producto)
                        <form action="/dashBoard/productos/{{$producto->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="acciones_links" type="submit">Eliminar</button>
                        </form>
                    @endcan
                </td>
            @else
                <td>{{$producto->producto}}</td>
                <td>{{$producto->precio}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>{{$producto->categoria_id}}</td>
                <td>
                  
                    <a class="acciones_links" href="/dashBoard/productos/{{$producto->id}}">Mostrar</a>
                    @can('delete', $producto)
                        <form action="/dashBoard/productos/{{$producto->id}}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="acciones_links" type="submit">Eliminar</button>
                        </form>
                    @endcan
                    @if (Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado')
                        <a class="acciones_links" href="/Productos/{{$producto->id}}/kardex">Kardex</a>
                    @endif
                    @if (Auth::user()->rol=='Cliente')
                        <a class="acciones_links" href="/Productos/{{$producto->id}}/responder">Preguntas</a>
                    @endif
                    
                    
                    
                </td>
            @endif
            
        </tr>
    @empty
        <tr>
        
        <td colspan="4">sin registros</td>
        </tr>
    @endforelse
</tbody>
</table>

@endsection
