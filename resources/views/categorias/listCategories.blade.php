@extends('dashBoard')
@section('listCategories')
<style>
    .actions{
        display: inline;
        text-align: center;
    }
    .createCategorie{
        text-align: center;
        font-size: 25px;
        background-color: #b0b0b0;
    }
</style>
@can('create', App\Models\Categoria::class)
    <div class="createCategorie"><a href="/Categorias/create">Agregar categoria</a></div>
@endcan

<div class="list_categories">
     @forelse ( $categorias as $categoria )
       <div class="category_item">
        <img src="{{ $categoria->imagen }}" class="img_cotegory">
        <label  class="lb_category">Categoría: {{ $categoria->nombre }}</label>
        <label class="lb_description">Descripción: {{ $categoria->descripcion }}</label>

       <div class="actions">
        @can('create', $categoria)
        <a class="link_category" href="/Categorias/{{$categoria->id}}/edit">Editar</a>
        @endcan
        <a class="link_category" href="/Categorias/{{$categoria->id}}">Visualizar categoría</a>
        @can('create', $categoria)
            <form action="/Categorias/{{$categoria->id}}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="link_category" type="submit">Eliminar</button>
            </form>
        @endcan
       </div>
        
       </div>
    @empty

    @endforelse
</div>
   
@endsection