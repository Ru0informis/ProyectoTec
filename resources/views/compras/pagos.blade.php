@extends('general')



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
input[type="checkbox"]:checked,:disabled {
  box-shadow: 0 0 0 3px orange;
}

    </style>
@section('pagos')
   
@if(session('mensaje'))
<div>
    {{session('mensaje')}}
</div>
@endif

<table class="table_categories">
<thead>
<tr class="link_add"><td colspan="8"><a href="/Compras/Pagos/Create">Agregar pago</a></td></tr>
<th>ID</th>
<th>Vendedor</th>
<th>Notas</th>
<th>Estado del pago</th>
<th>Fecha de pago</th>
<th>Monto</th>
</thead>
<tbody>
   @foreach ($pagos as $pago)
    <tr>

        @if ($pago->estado_pago == 2)
        <td><input type="checkbox" name="estado" checked id="{{$pago->id}}" onclick="updateStatus(this.id)"  style="cursor: pointer; "> {{$pago->id}}</td>
        @else
        <td><input type="checkbox" name="estado" id="{{$pago->id}}" onclick="updateStatus(this.id)"  style="cursor: pointer; "> {{$pago->id}}</td>
        @endif
        <td>{{$pago->vendedor}}</td>
        <td>{{$pago->notas}}</td>
        @if ($pago->estado_pago == 0)
        <td id="estado">Pendiente</td>
        @endif
        @if ($pago->estado_pago == 1)
        <td id="estado">Creado</td>
        @endif
        @if ($pago->estado_pago == 2)
        <td id="estado">Entregado</td>
        @endif
        <td>{{$pago->fecha_pago}}</td>
        <td>${{$pago->monto}}</td>
        

    </tr>
   
   @endforeach 
</tbody>
</table>
<script>
    function updateStatus(id){
        var status = document.getElementById('estado')
             $(document).ready(function(){
        $.ajax({
                url: '/Compras/updateStatusPago/'+id+'',
                method: 'GET',
                data: {
                    pago_id: id
                }
            }).done(function(res){
                var response = JSON.parse(res)
                alert(response.message)
                status.innerText = "Entregado   "
            });
        
    });
        }
   
</script>
@endsection