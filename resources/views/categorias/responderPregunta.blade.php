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
        @if ($tamaño=sizeof($preguntas)==0)
            No hay preguntas por responder
        @else
            
            @if (Auth::user()->rol=='Supervisor' || Auth::user()->rol=='Encargado')
                @foreach ($preguntas as $pregunta)
                <b>{{$pregunta->nombre}}</b> Pregunta: <i>{{$pregunta->pregunta}}</i> <br> 
                @if ($pregunta->respuesta==null)
                    <b>Vendedor responde:</b><i>Sin Respuesta</i><br><br>
                @else
                    <b>Vendedor responde:</b><i>{{$pregunta->respuesta}}</i><br><br>
                @endif
                
                @endforeach
            @endif
            @if ((Auth::user()->rol=='Cliente'))
                @foreach ($preguntas as $pregunta)
                <b>{{$pregunta->nombre}}</b> Pregunta: <i>{{$pregunta->pregunta}}</i> <br> 
                <form action="/Productos/{{$pregunta->pregunta_id}}/{{ $producto_id}}/enviarRespuesta">
                    <input name="respuesta" type="text" placeholder="escribe respuesta">
                    <input type="submit" value="enviar respuesta">
                </form>
                @endforeach
            @endif
            
            
        @endif
        
    </div>
</div>

@endsection