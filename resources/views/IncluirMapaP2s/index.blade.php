@extends('layouts3.app')
@section('content')


<!-- Passo 1 !-->
  <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><b>Lista de pacientes sem mapas </b></h5>
        <h6 class="card-title"><b></b></h6>
        </div>
    </div>
    <div><td>Macro:</td><td> {{ Auth::user()->macro}}</td> </div>
    <?php $m=Auth::user()->macro; ?>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <?php
    use App\Models\Categoria;
    use App\Models\Pacientes;
    $tabela = categoria::all();
?>
    <table class="table table-bordered">
        <tr>
            <th>MAPA</th>
            <th>Solicitação</th>
            <th>Hospital</th>
            <th width="280px">Ação</th>
        </tr>
<?php

/*$itensP = pacientes::where('macro',$m)->get(); */
 $itensP = Pacientes::select("*")
->where([
["statusSolicitacao", "=", 'N'],
["macro", "=", "$m"]
])->get();
?>	
    @foreach ($itensP as $paciente)
	    <tr>
            <td>{{$paciente->statusSolicitacao}}</td>
            <td>{{$paciente->solicitacao }}</td>
            <?php $a=$paciente->categorias_id; ?>

                @foreach($tabela as $item)
               <?php $b=$item->id; ?>
               <?php $c=$item->name; ?>
               <?php $macroCategoria=$item->macro; ?>
             
   
              <?php
                if($b==$a){
                    echo "<td>";
                    echo "$c";
                    echo "</td>";
                } ?>
                @endforeach
	   <td>
       <p class="card-text">
       <a href="{{route('incluirMapaP2s.create', ['id' => $paciente->id]) }}">Próxima Etapa</a>
       </p>
      </td>
	    </tr>
	    @endforeach
    </table>
@endsection



