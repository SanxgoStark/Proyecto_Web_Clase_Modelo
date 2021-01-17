<?php

include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
//var_dump($_POST);

/*No tengo el id de la encuesta*/
if(!isset($_SESSION['IdEncuesta']))
 if(isset($_POST['Id'])){
 	$_SESSION['IdEncuesta']=$_POST['Id']; /*Pero me o estan enviando?*/
 } 
 echo($_SESSION['IdEncuesta']);
 	
$reg = $oBD->saca_tupla("SELECT * FROM encuesta where Id=".$_SESSION['IdEncuesta']);

echo "<h3>Preguntas de la Encuesta :".$reg->Titulo."</h3>";

$query = "SELECT P.Id,Pregunta,Obligatoria,Requiere,Tipo,IdEncuesta from pregunta P join TipoPregunta TP on P.IdTipoPregunta = TP.Id where IdEncuesta=".$_SESSION['IdEncuesta'];



// si es enviado el post en la ccion
if (isset($_POST['accion'])) {
	// si fue enviado entonces puedo realizar una serie de acciones
	switch ($_POST['accion']) {

		case 'delete':
			$oBD->consulta("DELETE from pregunta where Id=".$_POST['Id']);
			// de mi objeto de la base de datos yo quiero desplegar la tabla
			echo $oBD->desplegarTabla($query,array(),array("update","delete"));
			//echo "borrando";
			break;

		case 'formUpdate': $registro=$oBD->saca_tupla("SELECT * FROM pregunta where Id=".$_POST['Id']);

		// como no hay break de cierre al ejecutar el caso FormUpdate se ejecuta el caso formUpdate

		case 'formNew':
			// echo "formNew";

			echo '<div class="conteiner">';
			echo (isset($registro->Id))?'<span class="badge badge-success">ACTUALIZAR PREGUNTA</span>':'<span class="badge badge-success">NUEVA PREGUNTA</span>';
				  echo '<form method="post">
				  <input type="hidden" name="accion" value="'.(isset($registro->Id)?"update":"insert").'"/>';
				  if(isset($registro->Id))
				  	echo '<input type="hidden" name="Id" value="'.$registro->Id.'"/>';
				  echo'<input type="hidden" name="IdEncuesta" value="'.$_SESSION['IdEncuesta'].'"/>
				  <div class="row">
				    <label class="col-md-4">Pregunta</label>
				    <div class="col-md-8"><input type="text" class="form-control" name="pregunta" value="'.(isset($registro->Id)?$registro->Pregunta:" ").'"/></div>
				  </div>
				  <div class="row">
				    <label class="col-md-4">Obligatoria</label>
				    <div class="col-md-8"><textarea class="form-control" name="obligatoria">'.(isset($registro->Id)?$registro->Obligatoria:" ").'</textarea></div>
				  </div>
				  <div class="row">
				    <label class="col-md-4">requiere</label>
				    <div class="col-md-8"><input type="text" class="form-control" name="requiere" value="'.(isset($registro->Id)?$registro->Requiere:" ").'"/></div>
				  </div>
				  <div class="row">
				    <label class="col-md-4">Tipo</label>
				    <div class="col-md-8">';
				    echo $oBD->creaSelect("TipoPregunta","Id","tipo","IdTipoPregunta",isset($registro->Id)?$registro->IdTipoPregunta:-1);
				    echo '</div>
				  </div>				  
				   <div class="row">
				    <div class="col-md-8">';
				    echo (isset($registro->Id))?'<button type="submit" class="btn btn-info"> Actualizar </button> <button type="submit" class="btn btn-info">
        					<a style="color:white" href="pregunta.php">Cancelar</a>
						</button>':'<button type="submit" class="btn btn-info"> Crear </button>   <button type="reset" class="btn btn-info">
        					<a style="color:white" href="pregunta.php">Cancelar</a>
						</button>';
				  echo ' </div> </div>
				  </form>
			</div></div>';
			break;

		case 'update':
			// echo "update";
			 $sub_query="UPDATE pregunta SET ";
			foreach ($_POST as $nombCampo => $valor) 
				// con esto estamos eliminando informacion que no se necesita en la conulta
				if(!in_array($nombCampo,array("accion","Id")))
				$sub_query.=$nombCampo."='".$valor."', ";
			// se retira la ultima coma de la consulta
			$sub_query= substr($sub_query,0,-2);
			// id sub_queryque estamos enviando del registro
			$sub_query.=" where Id=".$_POST['Id'];
			// ejecucion de query
		   $oBD->consulta($sub_query);
			// impresion del query que se esta ejecutando
			// echo $query;
		   echo $oBD->desplegarTabla($query,array(),array("update","delete"));
			break;

		case 'insert': 

			$sub_query="INSERT INTO pregunta SET ";
			foreach ($_POST as $nombCampo => $valor) 
				if(!in_array($nombCampo,array("accion")))
				$sub_query.=$nombCampo."='".$valor."', ";
			// se retira la ultima coma de la consulta
			echo $valor;
			$sub_query= substr($sub_query,0,-2);
			// ejecucion de query
		   $oBD->consulta($sub_query);
		   
			// impresion del query que se esta ejecutando
			// echo $query;
		   echo $oBD->desplegarTabla($query,array(),array("update","delete"));
			
			break;

			case 'list':
			/*sesion que guarda el id de la encuesta*/
			//$_SESSION['IdEncuesta']=$_POST['Id'];

			// de mi objeto de la base de datos yo quiero desplegar la tabla
			echo $oBD->desplegarTabla($query,array(),array("update","delete"));
			//echo "borrando";
			break;

		default:
			echo "No se ha programado: ".$_POST['accion'];
			break;
	}
}
else{
	echo $oBD->desplegarTabla($query,array(),array("update","delete"));
}

?>