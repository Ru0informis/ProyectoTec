@extends ('dashBoard')

@section('realizar_compra')

<form action="/productos/comprar/{{$producto->id}}/{{$producto->cantidad}}" style="margin-left: 10px; margin-top: 20px;" method="POST">
    @csrf
    <b>Producto:</b> {{$producto -> producto}}<br>
    <b>Descripcion:</b> {{$producto -> descripcion}}<br>
    <b>Precio unitario:</b> <label id="precio" style="color: black">{{$producto -> precio}}</label><br>
    <b>Disponibles:</b> <label id="precio" style="color: black">{{$producto -> cantidad}}</label><br>
    <b>Cantidad a comprar:</b> <input name="cantidadP" id = "cantidad" type="number" min="1" max="{{$producto -> cantidad}}" onclick="calcular()" ><br>
    <b>Total:</b>$<label id= "total" style="color: black">0</label><br>
    <input type="submit"  value="Realizar compra"> 
</form>
<script>

    var total=0
    var totalF = document.getElementById('total')
    var cantidad=document.getElementById('cantidad')
    var precio=document.getElementById('precio').innerHTML

        function calcular(){
            total= cantidad.value * precio
    totalF.innerHTML=total
        }
</script>
@endsection