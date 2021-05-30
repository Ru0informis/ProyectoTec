@extends('general')

@section('verProducto')
    
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
                        
                        <a class="link_product" href="{{ $producto->id }}">Comprar producto</a>
                    </div>
            @endforeach
        @endif
   
@endsection