@extends('dashBoard')

@section('responderPregunta')
    

@if (session('mensaje'))
<div>
    {{session('mensaje')}}
</div>    
@endif

<div class="container">
    <div class="pregunta_container">
        
    </div>
    <div class="mis_preguntas">
        @foreach ($preguntas as $pregunta)
           <b>{{$pregunta->nombre}}</b> Pregunta: <i>{{$pregunta->pregunta}}</i> <br> 
           <form action="/Productos/{{$pregunta->pregunta_id}}/{{ $producto_id}}/enviarRespuesta">
               <input name="respuesta" type="text" placeholder="escribe respuesta">
               <input type="submit" value="enviar respuesta">
            </form>
        @endforeach
    </div>
</div>

@endsection