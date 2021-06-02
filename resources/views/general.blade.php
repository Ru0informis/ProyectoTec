<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
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
           <div class="products_list">
            @yield('verProducto')
           </div>
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
                        <li class="navigation_item"><a class="navigation_link" href="/">Inicio</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/Categorias">Categorias</a></li>
                        <li class="navigation_item"><a class="navigation_link" href="/dashBoard/productos">Productos</a></li>
                        @can('show', App\Models\Usuario::class)
                        <li class="navigation_item"><a class="navigation_link" href="/Usuarios">Usuarios</a></li>
                        @endcan
                        <li class="navigation_item"><a class="navigation_link" href="/salir">Salir</a></li>    
                </ul>
        </div>
    </div>
    <div>
        @yield('resultadoBusquedaSupervisor')
        @if ($usuarios ?? '' == null || $categorias ?? '' ==null || $productos ?? '')
            
        @else
        <label style="color: black" for="nUsuarios">Usuarios Registrados:</label>
        <?php
            $cu=0;
        ?>
        @foreach ($usuarios ?? '' as $user)
            <?php
                $cu++;
            ?>     
        @endforeach
        <?php
            echo $cu;
        ?>
        <br>

        <label style="color: black" for="nUsuarios">Categorias Registradas: </label>
        <?php
            $cc=0;
        ?>
        @foreach ($categorias ?? '' as $categoria)
        <?php
            $cc++;
        ?>
        @endforeach
        <?php
            echo $cc;
        ?>
        <br>

        <label style="color: black" for="nUsuarios">Prodcutos Registrados: </label>
        <?php
            $cp=0;
        ?>
        @foreach ($productos ?? '' as $producto)
        <?php
            $cp++;
        ?>
        @endforeach
        <?php
            echo $cp;
        ?>
        @endif

        

        
        
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



