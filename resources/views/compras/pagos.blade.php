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
  box-shadow: 0 0 0 2px rgb(0, 0, 0);
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
<th id="h">Notas</th>
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
        <td id="padre">{{$pago->vendedor}}</td>

        <td id="m{{$pago->id}}" ondblclick="editMotivo(this.id, id_pago={{$pago->id}})">{{$pago->notas}} </td>

        @if ($pago->estado_pago == 0)
        <td id="estado{{$pago->id}}">Pendiente</td>
        @endif
        @if ($pago->estado_pago == 1)
        <td id="estado{{$pago->id}}">Creado</td>
        @endif
        @if ($pago->estado_pago == 2)
        <td id="estado{{$pago->id}}">Entregado</td>
        @endif
        <td>{{$pago->fecha_pago}}</td>
        <td>${{$pago->monto}}</td>
        

    </tr>
   
   @endforeach 
</tbody>
</table>
<script>
    function updateStatus(id){
        var status = document.getElementById('estado'+id)
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
                status.innerText = "Entregado"
            });
        
    });
        }
    function editMotivo(id, id_pago){
        var notas = document.getElementById(id) //obtengo la celda del motivo
        var posicion = notas.getBoundingClientRect() // obtengo la posicion exacta de la celda
        var nuevoMotivo = document.createElement("input") //aqui se ingresa el nuevo motivo
        var div = document.createElement("div") // creo un elemento  nuevo
        var btn = document.createElement("button") // creo un nuevo boton
        var anchoCampo= document.getElementById('h').clientWidth //aqui obtengo el ancho de la celda

        // estilos para el div
        div.style.width = anchoCampo
        div.style.display = 'flex'
        div.style.position = 'absolute'
        div.style.top = posicion.top
        div.style.padding = '3px'
        //estilos para el input text del nuevo motivo
        nuevoMotivo.type = 'text'
        nuevoMotivo.style.width = anchoCampo
        nuevoMotivo.style.height = '25px'
        var txtNuevoMotivo = 'N'+id
        nuevoMotivo.setAttribute('id', txtNuevoMotivo)
        nuevoMotivo.setAttribute('placeholder','Escribe algo')

        var btnEnviar = 'btn'+id
        btn.innerText = 'Enviar';
        btn.setAttribute('id', btnEnviar)
        

        notas.appendChild(div)

        div.appendChild(nuevoMotivo)
        div.appendChild(btn);      
        console.log(notas)
        //console.log(notas.textContent)
        //console.log(txtMotivo)
        document.getElementById(btnEnviar).addEventListener('click', function(){
            var notaNueva = document.getElementById(txtNuevoMotivo).value
            
            
            $(document).ready(function(){
                $.ajax({
                        url: '/Compras/updateNota/'+id+'',
                        method: 'GET',
                        data: {
                            pago_id: id_pago,
                            nota: notaNueva
                        }
                    }).done(function(res){
                        var response = JSON.parse(res)
                        alert(response.message)
                        notas.innerText = notaNueva
                        div.style.display= 'none'
                    });
                
                });
            });
    }

   
</script>
@endsection