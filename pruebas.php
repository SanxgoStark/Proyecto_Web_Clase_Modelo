<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<?php  

include "class/classBaseDatos.php";

// $iconos indican acciones que se pueden hacer en la tabla
function desplegarTabla($query,$anchtable=array(),$iconos=array(),$coLoTabla="table-primary"){

	global $oBD;

	$registros = $oBD->consulta($query);

	$columnas = mysqli_num_fields($registros);
	echo '<table class= "table table-hover'.$coLoTabla.'">';
	// creacion de la cabecera
	echo '<tr class="table-dark">';// hace el renglon

	// if (count($anchtable)){
	// 	foreach ($anchtable as $anch) {
	// 		echo "<td style=width:$anch.'%';></td>";
	// 		echo $anch;
	// 	}
	// }
$k = 0;
// si el count de iconos existe entonces me mandaron iconos 
	if (count($iconos)){
		foreach ($iconos as $icono) {
			echo $k;
					
			if (count($anchtable)) {
				echo "<td style=width:$anchtable[$k];>&nbsp;</td>";	
			}else{
				echo "<td>&nbsp;</td>";	
			}

			$k++;
		}
	}
	//echo $columnas;
	echo $k;
	//$k=$k-1;
	for ($c=0; $c < $columnas; $c++){
		// para traer los nombres de los campos
		$campo=mysqli_fetch_field_direct($registros,$c); // da la informacion de un campo en la base de datos
		 
		 if (count($anchtable)) {
				echo "<td style=width:$anchtable[$k];>$campo->name.$c</td>";	
			}else{
				echo '<td style="width:(90/$columnas)%">'.$campo->name.'</td>';		
			}
		 // echo $anchtable[$c];
		 $k++;
		
	}
	echo '</tr>';
	// fin cabecera
	// comienzo de registros
	for ($r=0; $r < $oBD->numeRegistros; $r++) 
	{ echo '<tr>';
		// agregando iconos
		// EN EL CASO DE QUE "UPDATE EXISTA EN EL ARRGLO DE LOS ICONOS"
		if (in_array("update", $iconos)) {
			//da comportamiento de los iconos
			echo '<td style="width:5%"><img src="imagenes/update.png"></td>';
		}

		if (in_array("delete", $iconos)) {
			//da comportamiento de los iconos
			echo '<td style="width:5%"><img src="imagenes/delete.png"></td>';
		}


		$campos = mysqli_fetch_array($registros);
		// despliega la informacion de un registro especifico
		for ($c=0; $c < $columnas; $c++) 
			echo '<td>'.$campos[$c].'</td>';
	  echo '</tr>';
		
	}
echo '</table>';
echo $k;
}


?>

<form>
	<input type="" name="renglones">
	<input type="" name="columnas">
	<button>Mostrar</button>
</form>

<!-- si me estan enviando por get los renglones -->

<?php

if (isset($_GET['renglones']))
{
	desplegarTabla("SELECT * from tipoencusta",array('4%','4%','45%','45%','11%','11%','11%','11%','11%'),
		array("update","delete"),
		"table-warning");

	desplegarTabla("SELECT * from usuario",array(),
		array("update","delete"),
		"table-warning");
}

// Explicacion arreglos asociativos

// $datos4[2]=34;
// $datos4["3.6"]=234;
// $datos4[3]=29;
// $datos4['suma']=34.6;
// echo "<hr>";
// foreach ($datos4 as $nombreCelda => $ValorCelda) {
// 	echo $nombreCelda." = ".$ValorCelda."<br>";
// }

// //cuenta cuantos elementos comtiene un arreglo
// count(var);

// // funcion que busca una aguja en un pajar
// in_array(45,$datos4);// regresa booleano

// // funcion para agregar a un arreglo al final
// array_push($datos4, "hola tec");

// $registros = $oBD->consulta("SELECT * from usuario");
// echo "<hr>";
// // el for each incluye un fetch array con el nombre de las columnas
// foreach ($registros as $registro) {
// 	echo $registro['Id']."<br>";
// }

// //otra forma a la anterior
// $registros = $oBD->consulta("SELECT * from usuario");
// echo "<hr>";
// // el for each incluye un fetch array con el nombre de las columnas
// foreach ($registros as $registro) {
// 	foreach ($registro as $vari) {
// 		echo $vari." ";
// echo "<hr>";
// 	}
// } 

// // ejemplo de array asociativo
// $a = array("nombre"=>"pedro", "edad"=>34, "sueñdo"=>5678.76);
?>


