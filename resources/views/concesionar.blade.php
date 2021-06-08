@extends('dashBoard')
@section('concesionar')
<style>
    .lb_p{
        color: black;
        font-size: 20px;
    }.div_concesionar_p{
        margin-top: 15px;
        margin-left: 10px;
        display: flex;
        flex-direction: column;
    }
    form{
        display: flex;
        flex-direction: column;
    }
    textarea{
        padding: 5px;
        resize: none;
        width: 500px;
    }
    #texAceptar{
        padding: 5px;
        width: 100px;
    }
    #btnSend{
        margin-top: 10px;
        margin-bottom: 20px;
        margin-left: 15%;
        width: max-content;
        padding: 5px;
    }
</style>
    <div class="div_concesionar_p">
        <img src="{{$producto->imagen}}" width="30%">
        <label class="lb_p">{{$producto->producto}}</label>
        <label class="lb_p">${{$producto->precio}}</label>
        <label class="lb_p">{{$producto->descripcion}}</label>
        <form action="/dashBoard/productos/concesionar/{{$producto->id}}/concesionar" method="POST">
            @csrf
            ¿Aceptar? <input id="texAceptar" type="text" placeholder="Escribe SI o NO" name="respuesta" required>
            Nota:<small><i>dejar vacío si se acepta el producto</i></small>
            <textarea name="motivo" id="" cols="30" rows="10" placeholder="Motivo por el cual rechaza el producto"></textarea>
            <input id="btnSend" type="submit" value="Aceptar">
        </form>
    </div>
@endsection