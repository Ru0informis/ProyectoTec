@extends('bitacora')

@section('verHistorial')
    @foreach ($historial as $historial )
        @if ($historial->accion =="Se registro")
            Fecha de registro: {{$historial->cuando}}
        @else
            
        @endif
    @endforeach
    <br> Transacciones hechas: 0 <br>
    Productos a la venta: 0

@endsection