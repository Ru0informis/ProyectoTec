@extends('general')

@section('registro')
    @if(session('mensaje'))
        <div>
            {{session('mensaje')}}
        </div>
    @endif
    <style>
        form{
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            display: flex;
            flex-direction: column;
        }
        input{
            margin-top: 5px;
        }
        .btn{
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
        <form action="/agregar" method="post" enctype="multipart/form-data">
            @csrf
            Nombre: <input type="text" name="nombre">
            Apellido paterno: <input type="text" name="a_paterno"> 
            Apellido materno: <input type="text" name="a_materno"> 
            
            <div style="display: flex">
                Correo: <input id="correo" type="text" name="correo"><p id="valores"></p>
            </div>
            Imagen: <input type="file" name="imagen" accept="image/*">
            @error('imagen') <small>{{$message}}</small> @enderror <br>
            Password: <input type="password" name="password"> 
            Confirmar password: <input type="password" name="password2"> 
            <input class="btn" id="btnAdd" type="submit" value="Agregar">
        </form>
    <script>
        $(document).ready(function() {
            var correo = document.getElementById('correo');
            var _token = $("input[name='_token']").val();
            var input = document.getElementById('correo');
            var log = document.getElementById('valores');
            correo.addEventListener('input', updateValue)

            function updateValue(e) {
                $.ajax({
                    url: '/agregar/validarEmail/',
                    method:'GET',
                    data: {email:correo.value}
                }).done(function(res){
                    response = JSON.parse(res);
                    log.innerText = response
                });
            }
        });
    </script>
@endsection