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
            <label class="lbl_header">Bienvenido a Tienda Proyecto</label>
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
        <div class="registro">
             @yield('registro')
        </div>
    </div>
@else
<div class="header_container">
        <center><label class="lbl_header">Bienvenido a Tienda Proyecto</label></center>
        <div class="navigation_icon_menu">
            <img class="navigation_icon" id='menuIcon' src="static/img/menu.png">
        </div>
        @yield('breadcumb')
        </div>
    <div class="navigation_container" id="menu">
            <ul class="navigation_list">
                    <li>
                    <center>
                    <img class="img_user" width="100px" height="100px" src="{{ asset(Auth::user()->imagen) }}" alt=""><br>
                    <label class="lb_user">Nombre: {{ Auth::user()-> nombre }} {{ Auth::user()-> a_paterno }} {{ Auth::user()-> a_materno }} ({{ Auth::user()-> rol }})</label> 
                    </center>
                    </li>
                    <li class="navigation_item"><a class="navigation_link" href="/Clientes/{{ Auth::user()-> id }}/edit">Actualizar mis datos</a></li>
                    @if ((Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado'))
                        <li class="navigation_item"><a class="navigation_link" href="/index">Inicio</a></li>
                    @endif
                    
                    <li class="navigation_item"><a class="navigation_link" href="/Categorias">Categorias</a></li>
                    <li class="navigation_item" id="navigation_item_submenu">Productos
                        <ul>
                            <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos">Productos venta</a></li>
                            <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos/compras">Productos comprados</a></li>
                        </ul>
                    </li>
                    @can('show', App\Models\Usuario::class)
                    <li class="navigation_item" id="navigation_item_submenu">Usuarios
                        <ul>
                            <li><a class="navigation_link" href="/Usuarios">Ver usuarios</a></li>
                            <li><a class="navigation_link" href="/historialUsuarios">Historial usuarios</a></li>
                        </ul>
                    </li>
                    @endcan
                    <li class="navigation_item"><a class="navigation_link" href="/salir">Salir</a></li>    
            </ul>
</div>
</div>
        <div class="content_views">
            @yield('listCategories')
             @yield('resultadoBusqueda')
             @yield('categoria')
             @yield('usuarios')
             @yield('Tproductos')
             @yield('create')
             @yield('edit')
             @yield('show')
             @yield('concesionar')
             @yield('preguntas')
             @yield('responderPregunta')
             @yield('realizar_compra')
             @yield('shomCompras')

        </div>
</div>

    <script>
        const iconMenu = document.getElementById('menuIcon'), menu = document.getElementById('menu');
        iconMenu.addEventListener('click', (e) => {
            console.log("hola")
            menu.classList.toggle('active')
            document.body.classList.toggle('opacity');
            const iconmMenuSelected = e.target.getAttribute('src');
            if(iconmMenuSelected == "http://mycarritoonline.test/static/img/menu.png"){
                e.target.setAttribute('src','http://mycarritoonline.test/static/img/menu_selected.png')
            }else{
                e.target.setAttribute('src','http://mycarritoonline.test/static/img/menu.png')
            }
        });
    
    </script>
</body>
@endguest 
</html>