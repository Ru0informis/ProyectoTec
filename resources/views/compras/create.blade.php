@extends('general')
@section('create_pago')
<style>
    .table_categories{
     
     border-spacing: 0;
     width: 100%;

        }
    .link_add{
            background-color: #009CFF;
            text-align: center;
            font-size: 20px;
        }
    .link_add:hover{
            background-color: #006EFF;
        }
    a{
        color: black;
    }
    th{
        background-color: #00FFFF;
    }
    th, td{
        width: min-content;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        
    }
    tr:hover{
        background-color: #006EFF;
        cursor: pointer;
    }
    .acciones_links{
        background-color: rgba(255, 255, 255, 0);
        font-size: 18px;
        padding: 2px;
        border: 0;
    }
    .acciones_links:hover{
        background-color:#006EFF ;
    }
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
}
#acciones{
    width: 200px;
}
.acciones_items{
    justify-content: space-between;
    display: flex;
    flex-wrap: wrap;
    width: auto;

}
#total{
    position: relative;
    float: right;
    right: 106px;
}
</style>
    <form>
        @csrf
        <select id ="selectVendedor">
            <option id="vendedor">Seleccione un vendedor para mas detalles</option>
            @foreach ($pagosP as $pago)
            <option  value="{{ $pago->id_vendedor }}">id_v: {{ $pago->id_vendedor }}, Vendedor: {{ $pago->vendedor }} , Pago: pendiente</option>
            @endforeach
        </select>
        <button id="btnPago">Consultar</button>
    </form>
   
<table class="table_categories" id="tablePagos">
<thead>
<th>Producto</th>
<th>Fecha de venta</th>
<th>Cantidad</th>
<th>Monto</th>
</thead>
<tbody id="tBody">
    </tr>
</tbody>
</table>
<label id="total"></label>
<form>  <button id="btnEnviar">Enviar</button></form>
<script>
    $(document).ready(function() {
        var id_vendedor
        var total
        $("#btnPago").click(function(e){
            e.preventDefault()
            id_vendedor = $("#selectVendedor").val();
            console.log(id_vendedor)
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: '/Compras/'+id_vendedor+'',
                method: 'GET',
                data: {_toke:_token,id_vendedor:id_vendedor}
            }).done(function(res){
                var response = JSON.parse(res);
                var tBody = document.getElementById('tBody')
                var total_pagar = 0
                console.log(response)    
                for(var i = 0; i<response.length; i++){
                    total_pagar += response[i].Total
                    var venta = "<tr><td>"+ response[i].producto+"</td>"
                    venta += "<td>"+ response[i].fecha_compra+"</td>"
                    venta += "<td>"+ response[i].cantidad+"</td>"
                    venta += "<td>$"+ response[i].Total+"</td></tr>"
                    $('#tBody').append(venta)
                    $('#tBody').append("")
                }
                document.getElementById('total').style.color="black"
                document.getElementById('total').innerText = "Total: $"+total_pagar
                
                total = total_pagar
            });
        });
        $("#btnEnviar").click(function(e){
            e.preventDefault()
            var _token = $("input[name='_token']").val();
            $.ajax({
                    url: '/Compras/'+id_vendedor+'',
                    method:'PUT',
                    data: {_token:_token,id_vendedor:id_vendedor, monto:total, estado:1}
                }).done(function(res){
                    response = JSON.parse(res);
                    alert(response.message);
                });
        });
    });
</script>
@endsection