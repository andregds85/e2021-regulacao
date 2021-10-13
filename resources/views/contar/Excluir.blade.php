@extends('layouts3.app')
@section('content')
<?php 


 
 use App\Http\Controllers\IncluirMapaP2sController;
 use App\Models\incluir_mapa_p2;

 $a=incluir_mapa_p2::all();
 $b=incluir_mapa_p2::where('id', $id)->delete();

?>

<div class="alert alert-secondary" role="alert">
 Paciente <?php echo $id; ?> retirado do Mapa. 
</div>

@endsection



