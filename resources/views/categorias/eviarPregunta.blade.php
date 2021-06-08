@if (session('mensaje'))
<div>
    {{session('mensaje')}}
</div>    
@endif

<div class="container">
    <div class="pregunta_container">
        Producto: {{$producto->producto}} <br> Descripcion: {{$producto->descripcion}} <br> Precio:${{$producto->precio}} <br>
        <form action="/Categorias/{{$producto->id}}/EnviarPregunta" method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Por favor redacte su pregunta</label><br>
            Pregunta: <input type="text" name="pregunta">
            <input class="btn" type="submit" value="Enviar">
        </form>
    </div>
    <div class="mis_preguntas">
        @foreach ($preguntas as $pregunta)
            <div class="mi_pregunta">
                Me: {{$pregunta->pregunta}}
            </div>
            @if ($pregunta->respuesta == null)
            <div class="mi_respuesta">
                sin respuesta
            </div>
            @else
                <div class="mis_respuesta">
                    Me: {{$pregunta->respuesta}}
                </div>
            @endif
        @endforeach
    </div>
</div>