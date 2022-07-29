@extends('layouts3.app')
@section('content')

<?php
use App\Http\Controllers\MapasController;
use App\Models\mapas;
use App\Models\finalMaps;
use App\Models\Pacientes;
use App\Http\Controllers\mapahospitalController;
use App\Http\Controllers\finalMapsController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MunicipioController;
use App\Models\incluir_mapa_p2;
use App\Models\mapahospital;
use App\Models\municipio_mapa_p3;
$perfil= Auth::user()->perfil;
$regiao= Auth::user()->macro;
?>
<div class="container">
<?php 
$perfil= Auth::user()->perfil;
if($perfil<>"regulacao"){
 session()->flush();
}
use App\Http\Controllers\IncluirMapaP2sController;
$id=$_GET['id']; 
$tabela = mapas::all(); 
$itens  = mapas::where('id',$id)->get();
?>

@foreach ($itens as $mapa)
       
   <!-- Passo 2 !-->
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><b>Hospital : {{$mapa->categoria_id}}</b></h5>
          <h6 class="card-title"><b></b></h6>
          <p class="card-text"><b> Id: {{$mapa->id }} </b></p>
          <?php $idm=$mapa->id; ?>
          <?php $macro=$mapa->macro; 
          
          if ($regiao<>$macro){
             session()->flush();
          return view('home');
          }
          
          ?>
          <p class="card-text"><b> Nome do Mapa: {{$mapa->nome }} </b></p>
          <p class="card-text"><b> Especialidade: {{$mapa->especialidade }} </b></p>
          <p class="card-text"><b> Procedimento: {{$mapa->procedimento }} </b></p>
          <p class="card-text"><b> Vagas: {{$mapa->vagas }} </b></p>
          <p class="card-text"><b> Criado em : {{$mapa->created_at }} </b></p>
          <p class="card-text"><b> Atualizado em : {{$mapa->updated_at }} </b></p>
      </div>  
      </div> 
 @endforeach

<div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title"><b>Total de pacientes nesse mapa : 
      <b><?php 
      echo $contarVagas=incluir_mapa_p2::where('idMapa', $idm)->count();
      ?>
      </b>
      </h5>
      <h6 class="card-title"><b></b></h6>
        <BR>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title"><b>Pacientes do Mapa: 
      </b>
      </h5>
      <h6 class="card-title"><b></b></h6>
        <BR>
    </div>
  </div>

<?php 
$tabela = incluir_mapa_p2::all(); 
$items  = incluir_mapa_p2::where('idMapa',$idm)->get();
?>

@foreach ($items as $m)

   <div class="card mb-3">
   <div class="card-body">
   <p class="card-text"><b> Id do Registro: {{$m->id }} </b></p>
          <?php $idReg=$m->id; ?>
          <h5 class="card-title"><b>Id do Paciente: {{$m->idPaciente}}</b></h5>

          <br><br>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
Regulação</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Regulação </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      Dados do Paciente
          Id do Mapa: {{$m->idMapa }} 

          <?php 
              $buscoPac = Pacientes::all();   
              $pacBuscou = Pacientes::where('id',$m->idPaciente)->get(); 
              ?>
              @foreach ($pacBuscou as $z)

           <b>Código da Solicitação: </b> {{$z->solicitacao }}<br>
           <b>Data da Inserção :</b>{{$z->created_at }}<br>
           <b>CNS:</b>{{$z->cns }}<br>
           <b>Municipio:</b>{{$z->municipio }}<br>
           <b> Nome do Usuário: </b> {{$z->nomedousuario}}<br>
           <b> Macro:</b> {{$z->macro}}<br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>






           
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
 Municipio
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Municipio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
      $tabelap3 = municipio_mapa_p3::all();
      $vbobserv = municipio_mapa_p3::where('idPaciente',$m->idPaciente)->get();
      echo  $observacao = municipio_mapa_p3::where('idPaciente',$m->idPaciente)->count();
  if($observacao==0){
    echo "Falta o municipio inserir a Observação";
  }?>
<br>


@foreach ($vbobserv as $o)
<b>Id do Registro / Observação Municipio:</b>{{$o->id }}<br>
<b>Observação do Municipio:</b>{{$o->observacao }}<br>
<b>Id paciente:</b>{{$o->idPaciente }}<br>
<b>Id Referencia:</b>{{$o->idp2 }}<br>      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Hospital
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hospital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
$tab = mapahospital::all();
$hosp = mapahospital::where('idPaciente',$m->idPaciente)->get();
/*
echo  $observacao = mapahospital::where('idp2',$ref)->count();
  if($observacao==0){
    echo "Falta o municipio inserir a Observação";
  }  */ ?>
<br>
	

@foreach ($hosp as $o1)
<b>Id Referencia:</b>{{$o1->idp3 }}<br>
<b>Prontuário do Hospital:</b>{{$o1->prontuarioHospital }}<br>
<b>Data da Cirurgia:</b>{{$o1->prontuarioHospital }}<br>
<b>Observação do Hospital:</b>{{$o1->obsHospital }}<br>
<b>Realizou Cirurgia Sim / Não </b>{{$o1->realizou }}<br>
<b>Usuário:</b>{{$o1->usuario }}<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>












       <p class="card-text">
       <a class="btn btn-danger" href="{{url('excluir', ['id' => $m->id]) }}">Excluir</a>
       </p>


     </div>
    </div>


@endforeach
@endforeach
@endforeach
@endforeach
@endsection
        </div>
