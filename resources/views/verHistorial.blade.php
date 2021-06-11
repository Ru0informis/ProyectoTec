@extends('bitacora')

@section('verHistorial')
<?php $i=0; ?>
    @foreach ($historial as $historial )
        @if ($i==0)
            Fecha de registro del vendedor: {{$historial->cuando}} <br>
            productos vendidos: <br>
        @endif
        
         {{$historial->producto}} <br>
        <?php $i=1; ?> 
    @endforeach
    

@endsection