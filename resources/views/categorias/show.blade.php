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
        <li>Categorías > </li>
        <li class="item_selected">Ver categoría</li>
    </ul>
</div>
@endsection
@section('show')
<div class="form_search">
    <form action="/buscarProducto/{{$categoriaId}}">
        @csrf
        Buscar: <input type="text" placeholder="Buscar un producto" name="buscarProducto"> 
        <button type="submit"><img src="../static/img/buscar.png" width="20px"></button>
    </form>
</div>
<div class="products_list">
         @if ($var = sizeof($productos) ==0)
        <div class="products_item">
            
            <label class="lb_product">No hay productos a mostrar</label>

        </div>
        @else
   
            @foreach ( $productos as $producto )
                    <div class="products_item">
                        <img src="{{ $producto->imagen }}" class="img_product">
                        <label class="lb_product">Producto: {{ $producto->producto }} </label>
                        <label class="lb_product">Precio:$ {{ $producto->precio }}</label>
                        <label class="lb_description">Descripción: {{ $producto->descripcion }}</label>
                        @if (Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado')
                            
                        @endif
                        @if (Auth::user()->rol=='Cliente')
                            <a class="link_product" href="/Categorias/{{ $producto->id }}/preguntar">Hacer Pregunta</a><br>
                            <a class="link_product" href="/productos/comprar/{{ $producto->id }}">Comprar producto</a>
                        @endif
                    </div>
            @endforeach
        @endif    
</div>
@endsection