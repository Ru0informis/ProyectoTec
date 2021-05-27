<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/estilo.css">
    <title>Bienvenido uwu</title>
    
</head>

<body>
    @if(session('error'))
        {{session('error')}}
    @endif
    
    <div class = "login-box">
        <img class= "avatar" src="static/logo.png" alt = "Logo">

            <h1> Bienvenido</h1>
            <form class="form_login" action="/validar" method="POST">
            @csrf
                <label for="username"> Usuario</label>
                <input type="text" name="name" placeholder="Ingrese Usuario">

                <label for="password"> Contraseña</label>
                <input type="password" name="pass" placeholder="Ingrese contraseña">

                <button class="btn" type="submit" name="btnIniciar" value="login">
                     Ingresar
                </button>

            </form>
            
    </div>
</body>
</html>


