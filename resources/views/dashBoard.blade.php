<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <title>Panel de control</title>
</head>
<body>
    @guest
<section class="header">
        <div class="header_container">
            <label class="lbl_header">Bienvenido a My DashBoard online</label>
        </div>
    <div class="content">
        <div class="navigation_container">
                <nav class="navigation">
                    <lu class="navigation_list">
                        <li class="navigation_item"><a class="navigation_link" href="/"><img class="navigation_link_img" src="{{ asset('static/img/home.png') }}"> Iniciar sesión</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/registrar"><img class="navigation_link_img" src="{{ asset('static/img/categories.png') }}">Registrarse</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="#">Acerca de</a></li> 
                </nav>
        </div>
        <div class="content_views">
             @yield('registro')
        </div>
    </div>
@else
    <section class="header">
        <div class="header_container">
            <label class="lbl_header">Bienvenido a My DashBoard online</label>
        </div>
    </section>  
    <div class="content">
        <div class="navigation_container">
                <nav class="navigation">
                    <lu class="navigation_list">
                        <li>
                            <center>
                            <img width="100px" height="100px" src="{{ asset(Auth::user()->imagen) }}" alt="">
                            <br> Nombre: {{ Auth::user()-> nombre }} {{ Auth::user()-> a_paterno }} {{ Auth::user()-> a_materno }} ({{ Auth::user()-> rol }})
                            </center>
                        </li>
                    <lu class="navigation_list">
                        <li class="navigation_item"><a class="navigation_link" href="/Clientes/{{ Auth::user()-> id }}/edit">Actualizar mis datos</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/"><img class="navigation_link_img" src="{{ asset('static/img/home.png') }}"> Inicio</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/dashBoard/"><img class="navigation_link_img" src="{{ asset('static/img/categories.png') }}">Categorias</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos"><img class="navigation_link_img" src="{{ asset('static/img/products.png') }}">Productos</a></li>
                        @can('show', App\Models\Usuario::class)
                        <li class="navigation_item"><a class="navigation_link" href="/Usuarios"><img class="navigation_link_img" src="{{ asset('static/img/categories.png') }}">Usuarios</a></li>
                        @endcan
                        <li class="navigation_item"><a class="navigation_link" href="/salir"><img class="navigation_link_img" src="{{ asset('static/img/logout.png') }}">Salir</a></li>
                    </lu>
                </nav>
        </div>
        <div class="content_views">
             @yield('breadcumb')
             @yield('categoria')
             @yield('usuarios')
             @yield('Tproductos')
             @yield('create')
             @yield('edit')
             @yield('show')



        </div>
    </div>
</body>
@endguest 
</html>