@extends('general')

@section('resultadoBusquedaSupervisor')


    <label style="color: black">Productos encontrados: {{$size = sizeof($busqueda2)}} </label>
    @if ($size = sizeof($busqueda2)==0)
        el producto no existe
    @else
        @foreach ($busqueda2 as $producto )
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