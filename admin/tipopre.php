<?php
/*
include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";

// de mi objeto de la base de datos yo quiero desplegar la tabla
echo $oBD->desplegarTabla("SELECT * from tipoencusta");
*/

include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
//var_dump($_POST);

echo'<h3 aling="center">Tipo de Preguntas</h3>';

// si es enviado el post en la ccion
if (isset($_POST['accion'])) {
	// si fue enviado entonces puedo realizar una serie de acciones
	switch ($_POST['accion']) {

		case 'delete':
			$oBD->consulta("DELETE from tipopregunta where Id=".$_POST['Id']);
			// de mi objeto de la bases de datos yo quiero desplegar la tabla
			echo $oBD->desplegarTabla("SELECT * from tipopregunta",array(),array("update","delete"));
			//echo "borrando";
			break;

		case 'formUpdate': $registro=$oBD->saca_tupla("SELECT * FROM tipopregunta where Id=".$_POST['Id']);

			// echo "formNew";

			echo '<div class="container">

				<h3>Editar Tipo de pregunta</h3>

				<form method="post">

				<!--si existe un id de resgitros-->
				<input type="hidden" name="accion" value="'.(isset($registro->Id)?"update":"insert").'" />

				<!-- Se toma el registro que recuperamos -->
				<input type="hidden" name="Id" value="'.$registro->Id.'" />

				<div class="row">
					<label class="col-md-4">Tipo</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Tipo" value="'.(isset($registro->Id)?$registro->Tipo:"").'"/></div>
				</div>

				<div class="row">
					
					<div class="col-md-8"><button type="submit">Actualizar</button></div>
				</div>
				</form>
			</div>';

		// como no hay break de cierre al ejecutar el caso FormUpdate se ejecuta el caso formUpdate

			break;

		case 'formNew':
			// echo "formNew";

			echo '<div class="container">

				<h3>Nuevo Tipo de pregunta</h3>

				<form method="post">

				<!--si existe un id de resgitros-->
				<input type="hidden" name="accion" value="'.(isset($registro->Id)?"update":"insert").'" />


				<div class="row">
					<label class="col-md-4">Tipo</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Tipo" value="'.(isset($registro->Id)?$registro->Tipo:"").'"/></div>
				</div>


				<div class="row">
					
					<div class="col-md-8"><input type="submit"/></div>
				</div>
				</form>
			</div>';

			break;

		case 'update':
			// echo "update";
			 $queryu="UPDATE tipopregunta SET ";
			foreach ($_POST as $nombCampo => $valor) 
				// con esto estamos eliminando informacion que no se necesita en la conulta
				if(!in_array($nombCampo,array("accion","Id")))
				$queryu.=$nombCampo."='".$valor."', ";
			// se retira la ultima coma de la consulta
			$queryu= substr($queryu,0,-2);
			// id que estamos enviando del registro
			$queryu.=" where Id=".$_POST['Id'];
			// ejecucion de query
		   $oBD->consulta($queryu);
			// impresion del query que se esta ejecutando
			// echo $query;
		   echo $oBD->desplegarTabla("SELECT * from tipopregunta",array(),array("update","delete"));
			break;

		case 'insert':
			$queryi="INSERT INTO tipopregunta SET ";
			foreach ($_POST as $nombCampo => $valor) 
				if(!in_array($nombCampo,array("accion")))
				$queryi.=$nombCampo."='".$valor."', ";
			// se retira la ultima coma de la consulta
			$queryi= substr($queryi,0,-2);
			// ejecucion de query
		   $oBD->consulta($queryi);
			// impresion del query que se esta ejecutando
			// echo $query;
		   echo $oBD->desplegarTabla("SELECT * from tipopregunta",array(),array("update","delete"));
			
			break;
		default:
			echo "No se ha programado: ".$_POST['accion'];
			break;
	}
}else{
	echo $oBD->desplegarTabla("SELECT * from tipopregunta",array(),array("update","delete"));
}

?>

