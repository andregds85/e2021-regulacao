@extends('layouts3.app')
@section('content')
<?php 
$nome=$_GET['p_nome'];
?>

<div class="container">
<div><td>Macro:</td><td> {{ Auth::user()->macro}}</td> </div>
<?php $m=Auth::user()->macro; ?>


 

    <?php
    use App\Models\Categoria;
    use App\Models\Pacientes;

    $tabela = categoria::all();
?>




    <table class="table table-bordered">
        <tr>
            <th>Sigtap / Nome</th>
            <th>Hospital</th>
        </tr>
<?php

/*
$itensP = pacientes::where('macro',$m)->get(); */

$itensP = Pacientes::select("*")
->where([
["statusSolicitacao", "=", 'N'],
["macro", "=", "$m"],
['nomedousuario', 'LIKE', '%' . $nome . '%'],


])->get(); 

?>	

    @foreach ($itensP as $paciente)
	    <tr>
                
            <td><b>{{$paciente->id}}</b> /
            {{$paciente->codigo }}
            <br>
            {{$paciente->nomedousuario}}

        </td>
            <?php $a=$paciente->categorias_id; ?>
            
                @foreach($tabela as $item)
               <?php $b=$item->id; ?>
               <?php $c=$item->name; ?>
 
               

                <?php
                if($b==$a){
                    echo "<td>";
                    echo "$c";
                    echo "</td>";
                    echo "<td>";
                    echo $mac=$item->macro;
                    $_SESSION['mac'] = $mac;
                   } ?>
            
            @endforeach
            <form action="{{route('pacientes.destroy',$paciente->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('pacientes.show',$paciente->id) }}">Mostrar</a>

                    @csrf
                    @method('DELETE')
                    @can('pacientes-delete')
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>




@endsection
