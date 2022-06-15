@extends('layouts3.app')
@section('content')
<?php 
$hospital=$_GET['hospital'];
$hospital;

use App\Models\Categoria;
$hosp = categoria::all();

$m=Auth::user()->macro; 
$hosp1 = Categoria::where('id',$hospital)->get(); 
 

 ?>




      @foreach($hosp1 as $item1)
        <?php 

        echo $codHosp=$item1->id;
        echo "<br>";
        echo $nomeHosp=$item1->name;
        echo "<br>";
        echo $macroHosp=$item1->macro;

        if($macroHosp<>$m){

         echo "Esse usuário é diferente da Macro ";

        }else{

            echo "usuário igual ao da Macro";
        }

        ?>        
        



        
        @endforeach







@endsection
