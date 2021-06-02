<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
</head>
<body>
    <style>
        body{
        margin: 0;
        padding: 0;
        background: url(/static/frame.jpg) no-repeat center top;
        background-size: cover;
        font-family: sans-serif;
        height: 100vh;
        }
        form{
            color: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            width: 300px;

        }
        input::placeholder { color: rgba(255, 255, 255, 0.877); }
        button{
            margin-top: 10px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            
        }
        input{
            background-color: rgba(255, 255, 255, 0);
            border: none;
            border-bottom: 1px solid #fff;
            padding: 3px;
            font-size: 18px;
            color: white;
        }
        div{
            color: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            width: max-content;
        }
        #close_notification{
            width: max-content;
        }
    </style>
     <div id="session_error">
        @if(session('error'))
            {{session('error')}}<button onclick="closeN()" id="close_notification" >X</button>
        @endif
        @if(session('message'))
            {{session('message')}}<button onclick="closeN()" id="close_notification" >X</button>
        @endif
    </div>
    <form action="/updatePassword" method="POST">
        @method('PUT')
        @csrf
        Nombre <input type="text" placeholder="UsuarioEjemplo" name="name" required><br>
        Correo electrónico <input type="text" placeholder="email@ejemplo.com" name="email" required><br>
        Nueva contraseña <input type="password" placeholder="***********" name="pass" required>
        <button type="submit">Cambiar contraseña</button>
    </form>
    <script>
        var btnClose = document.getElementById('close_notification')
        var divSessionError =  document.getElementById('session_error')
        function closeN() {
           divSessionError.innerHTML = '';
        }
    </script>
</body>
</html>