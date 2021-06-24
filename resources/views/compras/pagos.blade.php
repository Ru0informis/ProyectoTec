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
<th>Fecha de pago</th>
<th>Monto</th>
</thead>
<tbody>
   @forelse ($pagos as $pago)
    <tr id="{{ $pagos->id }}" >
                
        <td>{{$pago->id}}</td>
        <td>{{$pago->vendedor}}</td>
        @if ($pago->notas == "")
        <td>----</td>
        @endif
        <td>{{$pago->fecha_pago}}</td>
        <td>${{$pago->monto}}</td>

    </tr>
   @empty
   <tr>
        
    <td colspan="4">sin registros</td>
    </tr>
   @endforelse 
</tbody>
</table>

@endsection