@extends ('dashBoard')

@section('realizar_compra')

<form action="">

producto {{$producto -> producto}}
<br>
Descripcion {{$producto -> descripcion}}
<br>

Precio unitario <label id="precio">{{$producto -> precio}}</label>
<br>

Cantidad a comprar: <input id = "cantidad" type="number" min="0" max="{{$producto -> cantidad}}" onclick="calcular()">
<br>

total: $
<label id= "total" style="color: black"> </label>
<br>
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

<input type="submit"  value="realizarCompra" > 
</form>

@endsection