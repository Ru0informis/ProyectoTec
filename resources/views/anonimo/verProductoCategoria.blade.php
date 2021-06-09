@extends('general')

@section('verProducto')
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
                        
                        
                    </div>
            @endforeach
        @endif    
</div>
       
   
@endsection