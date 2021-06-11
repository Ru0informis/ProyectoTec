@extends('bitacora')

@section('verHistorial')
<?php $i=0; ?>
    @foreach ($historial as $historial )
        @if ($i==0)
            Fecha de registro del vendedor: {{$historial->cuando}} <br>
        @endif
        
        productos vendidos: {{$historial->producto}} <br>
        <?php $i=1; ?> 
    @endforeach
    

@endsection