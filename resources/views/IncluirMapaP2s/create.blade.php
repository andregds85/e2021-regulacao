@extends('limpo.app')
@section('content')

<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = + x;
}
</script>


<div class="container">
<?php
print_r ($rec=$_GET['grupo_chk']);


$m=Auth::user()->macro;

use App\Models\Pacientes;
$tabela = Pacientes::all();
$itensP = Pacientes::where('id',$rec)->get();

use App\Models\incluir_mapa_p2;






?>
@foreach ($itensP as $paciente)
<?php $mpac=$paciente->macro; ?>
@endforeach 
<?php   
if($mpac<>$m){
    session()->flush();
}?> 

   <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vincular paciente ao mapa</h2>
                <div><td>Macro:</td><td> {{Auth::user()->macro}}</td> </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Houve algum erro na sua entrada<br><br>
            <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     }  @endforeach
            </ul>
        </div>
    @endif

<p class="mb-0"></p>
<br>
  

<p class="mb-0"></p>
<form action="{{ route('incluirMapaP2s.store') }}" method="POST">
    	@csrf

<br>

<?php 
use App\Models\mapas;
$tabelaMapa = mapas::all();
$tabelaM = mapas::where('macro',$m)->get();
?>
	           
             
 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">id do Mapa / Id do Hospital / Nome do Mapa</label>
                <select class="form-control" name="idMapa" id="mySelect" onchange="myFunction()">
                <option> Escolha o Mapa</option>
               
                @foreach ($tabelaM as $mapas)
                <option value='{{$mapas->id }}'> {{$mapas->id }} {{$mapas->categoria_id}}{{$mapas->nome }}</option>
            

                @endforeach
                </select>
            </div>
        </div>
</div>

<p id='demo'></p>


    

<?php

foreach( $rec as $paciente ) {

      echo $paciente;
      echo "<br>";
      $b="<p id='demo'></p>";
      echo $b; 

      Pacientes::where('id',$paciente)->update(['statusSolicitacao' => 'S']);   


}


?>






<br>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Confirmar Inserção do Paciente</button>
		    </div>
		</div>
    </form>



    


















    
@endsection






?>
</div>