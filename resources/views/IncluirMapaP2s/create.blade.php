@extends('layouts3.app')
@section('content')
<?php 
$id=$_GET['id'];
echo $id;

$m=Auth::user()->macro;

use App\Models\Pacientes;
$tabela = Pacientes::all();
$itensP = Pacientes::where('id',$id)->get();

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
  <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Caso tenha retirado o paciente da Fila.</h4>
  <p>E desistiu de continuar com a operação de vincular o paciente ao mapa</p>
  <hr>
  <p class="mb-0">Clique no botão abaixo para devolver o paciente a fila sem vinculação ao mapa.</p>
</div>

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
                <select class="form-control" name="idMapa" id="idMapa">
                @foreach ($tabelaM as $mapas)
                <option value='{{$mapas->id }}' > {{$mapas->id }} {{$mapas->categoria_id}}{{$mapas->nome }}</option>
                @endforeach
                </select>
            </div>
        </div>
</div>



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">Id do Paciente</label>
                <select class="form-control" name="idPaciente" id="idPaciente">
                <option value='<?php echo $id; ?>'><?php echo $id; ?></option>
                </select>
            </div>
        </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">Código da Solicitação</label>
                <select class="form-control" name="codSolicitacao" id="codSolicitacao">
                <option value='{{$paciente->solicitacao }}'>{{$paciente->solicitacao}}</option>
                </select>
            </div>
        </div>
</div> 


 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">CNS</label>
                <select class="form-control" name="cns" id="cns">
                <option value='{{$paciente->cns }}'>{{$paciente->cns }}</option>
                </select>
            </div>
        </div>
</div> 


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">Nome do Usuário</label>
                <select class="form-control" name="nomeUsuario" id="nomeUsuario">
                <option value='{{$paciente->nomedousuario}}'>{{$paciente->nomedousuario}}</option>
                </select>
            </div>
        </div>
</div> 



<?php 
$usuarioSistema=Auth::user()->email; 
$cpfUsuarioSistema=Auth::user()->cpf;
?>



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="Municipio">Nome do Municipio</label>
                <select class="form-control" name="municipio" id="municipio">
                <option value='{{$paciente->municipio}}'>{{$paciente->municipio}}</option>
                </select>
            </div>
        </div>
</div>        
   <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">Usuário do Sistema</label>
                <select class="form-control" name="usuarioSistema" id="usuarioSistema">
                <option value='<?php echo $usuarioSistema; ?>'><?php echo $usuarioSistema; ?></option>
                </select>
            </div>
        </div>
</div>            




<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">CPF do Operador</label>
                <select class="form-control" name="cpfUsuarioSistema" id="cpfUsuarioSistema">
                <option value='<?php echo $cpfUsuarioSistema; ?>'><?php echo $cpfUsuarioSistema; ?></option>
                </select>
            </div>
        </div>
</div>  



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <label for="exampleInputCategoria">Macro </label>
                <select class="form-control" name="macro" id="macro">
                <option value='<?php echo $m=Auth::user()->macro; ?>'><?php echo $m=Auth::user()->macro; ?></option>
                </select>
            </div>
        </div>
</div>


<br>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Confirmar Inserção do Paciente</button>
		    </div>
		</div>
    </form>
@endsection

