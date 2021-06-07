@extends('general')
@section('estadisticas')
<style>
    .lbl{
        color: black;
    }
</style>
@if ( is_null($usuarios) || is_null($categorias) || is_null($categorias))
        <label class="lbl"> Sin registros a mostrar</label>
    @else
    <label class="lbl">Cantidad de categorías: {{ $size = sizeof($categorias)}}</label><br>
    <label class="lbl">Categorías registradas: </label><br>
    @foreach ($categorias as $categoria )
        <label class="lbl">{{$categoria->nombre}}</label><br>
    @endforeach
    
       <label class="lbl" >Total de usuarios registrados:{{ $size = sizeof($usuarios)}}</label><br>
       <label class="lbl">Total de productos registrados:{{ $size = sizeof($productos)}}</label> 
    @endif
    
@endsection