@extends ('general')

@section('bitacoras')
<style>
    .user{
        display: flex;
        margin-top: 5px
    }
    .user_info{
        display: flex;
        flex-direction: column;
        margin-left: 10px;
    }
    .lb_users{
        color: black;
        font-size: 18px;
        margin-top: 8px;
        
        padding: 3px;
    }
    .lb{
        color: black;
        font-size: 20px;
    }
    .list_users{
        width: 40%;
        margin-top: 15px;
        margin-left: 10px;
    }
    .lb_users:hover{
        background-color: rebeccapurple;
    }
    .content_inf{
        display: flex;
    }
    .historial{
        padding: 10px;
        background-color: rebeccapurple;
        width: 300px;
        position: fixed;
        left: 50%;
    }
</style>

<div class="content_inf">
    <div class="list_users">
        <label class="lb">Usuarios registrados </label><i><small>(Click en el nombre para mas información)</small></i>
        @foreach ($usuarios as $usuario)
    
            <div class="user">
                <img src="{{ $usuario->imagen }}" width="25%">
                <div class="user_info">
                    <a href="/showHistory/{{$usuario->nombre}}/{{$usuario->id}}" class="lb_users">{{$usuario->nombre." ".$usuario->a_paterno." ".$usuario->a_materno}}</a>
                    <label class="lb">Rol: {{ $usuario->rol }}</label>
                </div>
            </div>
        @endforeach
    </div>
    <div class="historial">@yield("verHistorial")</div>
</div>


@endsection