@extends('general')

@section('compras')
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
    th{
        text-align: center;
        width: min-content;
       
        padding-top: 5px;
        padding-bottom: 5px;
    }
    td{
        text-align: center;
        font-size: 18px;
        vertical-align: top;
        padding: 5px;
        
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
#listC{
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
    margin-bottom: 5px;
}

.items:hover{
    background-color: #006EFF;
    cursor: pointer;
}
#comprobante_container{
    background: rgba(0, 0, 0, 0.404);
    width: 100%;
    position: absolute;
    left: 0;
    height: 100%;
    top: 0;
    text-align: center;
    display: none;
}
#comprobante{
    margin-top: 10%;
}
#btnClose{
    position: absolute;
    right: 10px;
    top: 20%;
}
</style>
<form>
    @csrf
    <select  id="compra" name="consulta">
        <option value="">seleccione una venta para ver mas detalles</option>
        @foreach ($compras as $compra)
            <option value="{{$compra->id}}">Compra: {{$compra->id}}, vendedor: {{$compra->Vendedor}} 
            @if ($compra->estado == 0) , Estado compra: pendiente @endif
            </option>
        @endforeach
    </select>
    <button id="btn-submit" >Consultar</button>
</form>


<div id="comprobante_container">
    <div id="close"><img id="btnClose" src="{{ asset('static/img/close.png') }}" width="50px"></div>
<img id="comprobante" alt="" width="50%">
</div>
<table class="table_categories">
    <thead>
    <th>Id</th>
    <th>Comprador</th>
    <th>Vendedor</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Fecha de compra</th>
    <th>Estado de la compra</th>
    <th>Total</th>
    <th>Comprobante de pago</th>
    </thead>
    <tbody>
            <tr class="items">
                </tr>
                    <td id="id"> </td>
                    <td id="comprador"> </td>
                    <td id="vendedor"> </td>
                    <td id="producto"> </td>
                    <td id="cantidad"> </td>
                    <td id="fecha"> </td>
                    <td id="estado"> </td>
                    <td id="total"> </td>
                    <td><button id="verComprobante">ver comprobante</button></td>
                <tr>
            </tr>
    </tbody>
    </table>
    <form>
        @csrf 
        <button id="validar">Validar</button> <br>
        
        <small><i>Nota: en caso de rechazar el deposito debera de indicar el ¿por qué?</i></small> <br>
        <textarea name="" id="motivo" cols="30" rows="10" placeholder="Ingrese un motivo" style="resize: none"></textarea> <br>
        <button id="rechazar">Rechzar</button>
    </form>


    <script type="text/javascript">
        var response
        var img
        $(document).ready(function() {
            $("#btn-submit").click(function(e){
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id = $("#compra").val();
                $.ajax({
                    url: "/Compras/validar",
                    method:'POST',
                    data: {_token:_token, id:id},
                }).done(function(res){
                    response = JSON.parse(res)
                    console.log(response);
                    document.getElementById('id').innerText = response[0].id;
                    document.getElementById('comprador').innerText = response[0].Comprador;
                    document.getElementById('vendedor').innerText = response[0].Vendedor;
                    document.getElementById('producto').innerText = response[0].producto;
                    document.getElementById('cantidad').innerText =response[0].cantidad;
                    document.getElementById('fecha').innerText = response[0].fecha_compra;
                    if(response[0].estado == 0){
                        document.getElementById('estado').innerText = "Pendiente"
                    }
                    document.getElementById('total').innerText = "$"+response[0].Total;
                    response[0].comprobante
                    $("#verComprobante").click(function(e){
                        e.preventDefault();
                        document.getElementById("comprobante_container").style.display="block"
                        document.getElementById('comprobante').setAttribute('src', response[0].comprobante); 
                        console.log( document.getElementById("comprobante_container"))
                    });
                    $("#close").click(function(e){
                        e.preventDefault();
                        document.getElementById("comprobante_container").style.display="none"
                    });
                });
            }); 

            $("#validar").click(function(e){
                e.preventDefault();
                var id = $("#compra").val();
            
                var _token = $("input[name='_token']").val();
                $.ajax({
                    url: "/Compras/validar/aceptar",
                    method:'POST',
                    data: {_token:_token, id:id, estado:1},
                }).done(function(res){
                    response = JSON.parse(res);
                    alert(response.message);
                });
            });
            $("#rechazar").click(function(e){
                e.preventDefault();
                var id = $("#compra").val();
                var motivo = $("#motivo").val();
                var _token = $("input[name='_token']").val();
                console.log(motivo)
                $.ajax({
                    url: "/Compras/validar/aceptar",
                    method:'POST',
                    data: {_token:_token, id:id, estado:1, motivo: motivo},
                }).done(function(res){
                    response = JSON.parse(res);
                    alert(response.message);
                });
            });
            
        });
        
    </script>










@endsection