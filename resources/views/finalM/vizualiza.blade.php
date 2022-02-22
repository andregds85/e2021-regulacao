@extends('limpo.app')
@section('content')
<?php 
use App\Models\mapas;
use App\Http\Controllers\MapasController;
use App\Http\Controllers\mapahospitalController;

use App\Models\incluir_mapa_p2;
use App\Models\mapahospital;
use App\Models\municipio_mapa_p3;

echo $id;
echo "<br>";

$tab = mapahospital::all();
$hosp = mapahospital::where('id',$id)->get();

?>
@foreach ($hosp as $o1)
<b>Preenchimento pelo Hospital</b><br>
<br>

<b>Id Referencia:</b>{{$o1->idp3 }}<br>
<b>Prontuário do Hospital:</b>{{$o1->prontuarioHospital }}<br>
<b>Data da Cirurgia:</b>{{$o1->prontuarioHospital }}<br>
<b>Observação do Hospital:</b>{{$o1->obsHospital }}<br>
<b>Realizou Cirurgia Sim / Não </b>{{$o1->realizou }}<br>

@endforeach

<?php
$muni = municipio_mapa_p3::all();
$municipio = municipio_mapa_p3::where('idp2',$o1->idp3)->get();
?>

<br>
<br>

<b>Preenchimento pelo Municipio</b><br>
<br>
	
@foreach ($municipio as $o)
<b>Id do Registro / Observação Municipio:</b>{{$o->id }}<br>
<b>Observação do Municipio:</b>{{$o->observacao }}<br>
<b>Id paciente:</b>{{$o->idPaciente }}<br>
<b>Id Referencia:</b>{{$o->idp2 }}<br>

@endforeach

<?php
$regula = incluir_mapa_p2::all();
$regulacao2 = incluir_mapa_p2::where('id',$o->idp2)->get();
?>




@foreach ($regulacao2  as $t2)

<table class="table table-bordered">
  <tbody>
    <tr>
      <td><b>Id do Mapa:</b>{{$t2->idMapa }} <br>
           <b>Id do Paciente:</b>{{$t2->idPaciente }}<br>
           <b>Código da Solicitação: </b> {{$t2->codSolicitacao }}<br>
           <b>Data da Inserção :</b>{{$t2->created_at }}<br>

           <b>CNS:</b>{{$t2->cns }}<br>

          
           <b>Municipio:</b>{{$t2->municipio }}<br>
     <b>Usuario do Sistema: </b> {{$t2->usuarioSistema }}<br>
     </td>
     <td>

    <b> Nome do Usuário: </b> {{$t2->nomeUsuario}}<br>
    <b> CPF do Usuário:</b> {{$t2->cpfUsuarioSistema}}<br>
    <b> Macro:</b> {{$t2->macro}}<br>

    

    @endforeach





@endsection

