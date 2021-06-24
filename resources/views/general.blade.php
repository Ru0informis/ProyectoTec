<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>Bienvenido</title>
</head>
<body >
@guest

    <div class="header_container">
            <center><label class="lbl_header">Bienvenido a Tienda Proyecto</label></center>
            <div class="navigation_icon_menu">
                <img class="navigation_icon" id='menuIcon' src="static/img/menu.png">
            </div>
        </div>
        
        <div class="navigation_container" id="menu">
               
                    <ul class="navigation_list">
                        <li class="navigation_item"><a class="navigation_link" href="/">Inicio</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/VerCategorias">Categorías</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/index">Iniciar sesión</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/registrar">Registrarse</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="#">Acerca de</a></li> 
                    </ul>
    
        </div>
        <div class="content_views" id="b">
            
           <div class="list_categories">
               @yield('listCategories')
           </div>
            @yield('verProducto')
           
           <div class="products_list_busqueda">
            @yield('resultadoBusqueda')
           </div>
            @yield('registro')
            
    </div>
       
@else
    <div class="header_container">
        <center><label class="lbl_header">Bienvenido a Tienda Proyecto</label></center>
            <div class="navigation_icon_menu">
                <img class="navigation_icon" id='menuIcon' src="static/img/menu.png">
            </div>
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
                        @can('comprasVerCompras', App\Models\Producto::class)
                        <li class="navigation_item" id="navigation_item_submenu">Productos
                            <ul>
                                <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos">Productos en venta</a></li>
                                <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos/compras">Productos comprados</a></li>
                            </ul>
                        </li>
                       
                        @endcan
                        @can('show', App\Models\Producto::class)
                            <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos">Productos</a></li>
                        @endcan
                        @can('show', App\Models\Usuario::class)
                            <li class="navigation_item" id="navigation_item_submenu">Usuarios
                                <ul>
                                    <li><a class="navigation_link" href="/Usuarios">Ver usuarios</a></li>
                                    <li><a class="navigation_link" href="/historialUsuarios">Historial usuarios</a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('pagos', App\Models\Compra::class)
                            <li class="navigation_item">Ventas
                                <ul>
                                    <a class="navigation_link" href="/Compras">->Validar venta</a>
                                    <a class="navigation_link" href="/Compras/Pagos">->Realizar pago</a>
                                </ul>    
                            </li> 
                        @endcan
                        <li class="navigation_item"><a class="navigation_link" href="/salir">Salir</a></li>    
                </ul>
        </div>
    </div>
    <div>
        @yield('estadisticas')
        @yield('resultadoBusquedaSupervisor')
        @yield('bitacoras')
        @yield('compras')
        @yield('pagos')
        @yield('create_pago')
    </div>
@endguest  
<script>
    const iconMenu = document.getElementById('menuIcon'), menu = document.getElementById('menu'), bo = document.getElementById('b');
    iconMenu.addEventListener('click', (e) => {
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
</html>



