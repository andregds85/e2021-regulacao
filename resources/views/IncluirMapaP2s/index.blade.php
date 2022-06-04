@extends('layouts3.app')
@section('content')
<div class="container">



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
            <th>ID</th>
            <th>Codigo</th>
            <th>Hospital</th>
        </tr>
<?php








/*$itensP = pacientes::where('macro',$m)->get(); */
 $itensP = Pacientes::select("*")
->where([
["statusSolicitacao", "=", 'N'],
["macro", "=", "$m"]
])->get();
?>	

<form action="{{route('incluirMapaP2s.create') }}" method="get">

    @foreach ($itensP as $paciente)
	    <tr>
            <td>

            <input type="checkbox" name="grupo_chk[]" value='{{$paciente->id}}'>
 
        </td>
           
            <?php $selected='grupo_chk[]'; ?>                 
    
            <td>{{$paciente->codigo }}</td>
            <?php $a=$paciente->categorias_id; ?>

                @foreach($tabela as $item)
               <?php $b=$item->id; ?>
               <?php $c=$item->name; ?>
               <?php $macroCategoria=$item->macro; ?>
       
              <?php
                if($b==$a){
                    echo "<td>";
                    echo "$c";
                } ?>
       
       @endforeach
  
    </td>
	    </tr>
	    @endforeach
    </table>

       <input type="submit" name="Enviar" value="Cadastrar">
</form>

@endsection
</div>



