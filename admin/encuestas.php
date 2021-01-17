<?php

include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";

// Se elimina de la sesion el idencuesta (esto ayuda a que al entrar a una encuesta cambie  de nombre)
unset($_SESSION['IdEncuesta']);
// query para el despliegue de tabla
$query = "SELECT E.Id,Titulo,Descripcion,Tipo from encuesta E join TipoEncusta TE on E.idTipo = TE.id where idUser=".$_SESSION['Id'];
//var_dump($_POST);

echo'<h3 aling="center">Encuestas</h3>';
// si es enviado el post en la ccion
if (isset($_POST['accion'])) {
	// si fue enviado entonces puedo realizar una serie de acciones
	switch ($_POST['accion']) {
		case 'delete':
			$oBD->consulta("DELETE from encuesta where Id=".$_POST['Id']);
			// de mi objeto de la base de datos yo quiero desplegar la tabla
			echo $oBD->desplegarTabla($query,array(),array("update","delete","addPreg","vista"));
			//echo "borrando";
			break;

		case 'formUpdate': $registro=$oBD->saca_tupla("SELECT * FROM encuesta where Id=".$_POST['Id']);

			// echo "formNew";

			echo '<div class="container">

				<h3>Editar encuesta</h3>

				<form method="post">

				<!--si existe un id de resgitros-->
				<input type="hidden" name="accion" value="'.(isset($registro->Id)?"update":"insert").'" />

				<!-- Se toma el registro que recuperamos -->
				<input type="hidden" name="Id" value="'.$registro->Id.'" />

				<div class="row">
					<label class="col-md-4">Titulo</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Titulo" value="'.(isset($registro->Id)?$registro->Titulo:"").'"/></div>
				</div>

				<div class="row">
					<label class="col-md-4">Descripcion</label>
					<div class="col-md-8"><textarea class="form-control" name="Descripcion" />'.(isset($registro->Id)?$registro->Descripcion:"").'</textarea></div>
				</div>

				<div class="row">
					<label class="col-md-4">Estatus</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Estatus" value="'.(isset($registro->Id)?$registro->Estatus:"").'"/></div>
				</div>

				<div class="row">
					<label class="col-md-4">IdTipo</label>
					<div class="col-md-8">';

				echo $oBD->creaSelect("tipoencusta","Id","Tipo","IdTipo",isset($registro->Id)?$registro->IdTipo:-1);


					   /* <input type="text" class="form-control" name="IdTipo" value="'.(isset($registro->Id)?$registro->IdTipo:"").'"/>*/

				echo '</div>
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

				<h3>Nueva encuesta</h3>

				<form method="post">

				<!--si existe un id de resgitros-->
				<input type="hidden" name="accion" value="'.(isset($registro->Id)?"update":"insert").'" />

				<!--Campo nuevo-->
				<input type="hidden" name="IdUser" value="'.$_SESSION['Id'].'" />

				<div class="row">
					<label class="col-md-4">Titulo</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Titulo" value="'.(isset($registro->Id)?$registro->Titulo:"").'"/></div>
				</div>

				<div class="row">
					<label class="col-md-4">Descripcion</label>
					<div class="col-md-8"><textarea class="form-control" name="Descripcion" />'.(isset($registro->Id)?$registro->Descripcion:"").'</textarea></div>
				</div>

				<div class="row">
					<label class="col-md-4">Estatus</label>
					<div class="col-md-8"><input type="text" class="form-control" name="Estatus" value="'.(isset($registro->Id)?$registro->Estatus:"").'"/></div>
				</div>

				<div class="row">
					<label class="col-md-4">IdTipo</label>
					<div class="col-md-8">';

				echo $oBD->creaSelect("tipoencusta","Id","Tipo","IdTipo",isset($registro->Id)?$registro->IdTipo:-1);


					   /* <input type="text" class="form-control" name="IdTipo" value="'.(isset($registro->Id)?$registro->IdTipo:"").'"/>*/

				echo '</div>

				</div>

				<div class="row">
					
					<div class="col-md-8"><input type="submit"/></div>
				</div>
				</form>
			</div>';
			break;

		case 'update':
			// echo "update";
			 $queryu="UPDATE encuesta SET ";
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
		   echo $oBD->desplegarTabla($query,array(),array("update","delete","addPreg","vista"));
			break;

		case 'insert':
			$queryi="INSERT INTO encuesta SET ";
			foreach ($_POST as $nombCampo => $valor) 
				if(!in_array($nombCampo,array("accion")))
				$queryi.=$nombCampo."='".$valor."', ";
			// se retira la ultima coma de la consulta
			$queryi= substr($queryi,0,-2);
			// ejecucion de query
		   $oBD->consulta($queryi);
			// impresion del query que se esta ejecutando
			// echo $query;
		   echo $oBD->desplegarTabla($query,array(),array("update","delete","addPreg","vista"));
			
			break;
		default:
			echo "No se ha programado: ".$_POST['accion'];
			break;
	}
}else{
	echo $oBD->desplegarTabla($query,array(),array("update","delete","addPreg","vista"));
}



?>