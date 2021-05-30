@extends('general')

@section('listCategories')
    
    @forelse ( $categorias as $categoria )
       <div class="category_item">
        <img src="{{ $categoria->imagen }}" class="img_cotegory">
        <label class="lb_category">Categoría: {{ $categoria->nombre }}</label>
        <label class="lb_description">Descripción: {{ $categoria->descripcion }}</label>
        <a href="" class="link_category">Visualizar categoría</a>
       </div>
    @empty

    @endforelse
@endsection