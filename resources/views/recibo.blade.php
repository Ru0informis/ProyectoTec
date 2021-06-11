@extends('dashBoard')
@section('recibo')

<center>
<h3> FAVOR DE AÑADIR EL COMPROBANTE</h3>
<form action="/dashBoard/productos/compras/{{$id}}"   method="post">
    @csrf
    <input type="file">
    <br>
    <input class="btn" type="submit" value="Enviar comprobante">


</form>
</center>

@endsection