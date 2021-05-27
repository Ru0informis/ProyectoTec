<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    <title>Bienvenido</title>
    
</head>
<body>
    @if(session('error'))
    <div>
        {{session('error')}}
    </div>
    @endif
    <form class="form_login" action="/validar" method="POST">
    @csrf
    <div class="form_title">Bienvenido hola gatoooos</div>
    <div>
    <center><label>Nombre</label></center>
    <input class="form_user" type="text" name="name">
    </div>
    <div>
    <center><label >Contraseña</label></center>
    
    <input class="form_user" type="password" name="pass">
    </div>
    <input type="submit" class="btnLog" value="LogIN"">
    </form>
    
</body>
</html>


