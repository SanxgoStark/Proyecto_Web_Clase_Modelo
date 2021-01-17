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

// if(!isset($_SESSION['IdTipoPregunta']))
//  if(isset($_POST['Id'])){
//  	$_SESSION['IdEncuesta']=$_POST['Id']; /*Pero me o estan enviando?*/
//  }
 	
/////////////////////////////////////////// Obtencion del titulo de la encuesta ////////////////  	
$reg = $oBD->saca_tupla("SELECT * FROM encuesta where Id=".$_SESSION['IdEncuesta']);

echo "<h3>Vista previa :".$reg->Titulo."</h3>";
///////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////// Consulta a ejecutarse /////////////////////////////
$query = "SELECT P.Id,Pregunta,Tipo from pregunta P join TipoPregunta TP on P.IdTipoPregunta = TP.Id where IdEncuesta=".$_SESSION['IdEncuesta'];

$queryp = "SELECT Id,Pregunta,Tipo from pregunta where Id=".$_SESSION['Id'];
///////////////////////////////////////////////////////////////////////////////////////////////


// si es enviado el post en la ccion
if (isset($_POST['accion'])) {
	// si fue enviado entonces puedo realizar una serie de acciones
	switch ($_POST['accion']) {

			case 'preview':

			echo $oBD->desplegarTabla($query,array(),array("pru"));
			
			break;

		default:
			echo "No se ha programado: ".$_POST['accion'];
			break;
	}
}
else{
	echo $oBD->desplegarTabla($query,array(),array());
}

?>