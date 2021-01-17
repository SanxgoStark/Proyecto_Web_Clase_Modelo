<?php
// Guarda objetos programables hacia la base de datos (comportamiento natural de una bd)
class BaseDatos{

	// cuando construya un objeto me gere la conexion
	var $conexion; // atributo

	// nos va   servir para ver si hubo un error y asi detener la ejecucion
	var $error;

	// se almacenan el numero de registros
	var $numeRegistros;

	function conecta(){
		// no aplicar signo de pesos a conexion al inicio con el $ del this esta bien 
			$this->conexion=mysqli_connect("localhost", "encuestador", '1234','encuestas');
		}

	function cierraBD(){mysqli_close($this->conexion); }

	function consulta($query){
			$this->conecta(); // se abre conexion
			// guardo consulta en bloque
			$bloque=mysqli_query($this->conexion,$query); // se realiza consulta

			// if si el cueri es un select
			if (strpos(strtoupper($query) , "SELECT")!==false)
			  // se almacena el numero de registros que contiene el bloque
			  $this->numeRegistros=mysqli_num_rows($bloque);
			else $this->numeRegistros=0;

			// dime que error hubo en esta conexion
			$this->error=mysqli_error($this->conexion);
			$this->cierraBD();
			//para en seco que me dice la consulta que ejecute y que me muestre el error
			if ($this->error>""){
				echo $query."  =>  ".$this-error; exit; // detente
			}



			// retorna el contenido de bloque por que es un select
			return $bloque;
		}

	// funcion que obtienen un registro	(esta funcion trae especificamente un registro)
	function saca_tupla($query){
			$this->conecta(); // se abre conexion
			// guardo consulta en bloque
			$bloque=mysqli_query($this->conexion,$query); // se realiza consulta
			// se almacena el numero de registros que contiene el bloque
			$this->numeRegistros=mysqli_num_rows($bloque);
			$this->cierraBD();
			// retorna solo el primer registro , el de esta arriba
			return mysqli_fetch_object($bloque);
		}

// funcion apara desplegar una tabla dinamica
// $iconos indican acciones que se pueden hacer en la tabla
function desplegarTabla($query,$anchtable=array(),$iconos=array(),$coLoTabla="table-primary"){

	//global $oBD;

	$registros = $this->consulta($query);

	//menciona cuantos regisros contiene
	$columnas = mysqli_num_fields($registros);
	$result = '<div class="container"><table class= "table table-hover'.$coLoTabla.'">';


	// creacion de la cabecera
	$result.= '<tr class="table-dark">'; // con el .= se concatena con el result anterior

	// if (count($anchtable)){
	// 	foreach ($anchtable as $anch) {
	// 		echo "<td style=width:$anch.'%';></td>";
	// 		echo $anch;
	// 	}
	// }
$k = 0;
// si el count de iconos existe entonces me mandaron iconos 
	if (count($iconos)){
		//foreach ($iconos as $icono) { // foreach pone tantas columnas como iconos teniamos
			// echo $k;
					
			if (count($anchtable)) {
				$result.= "<td style=width:$anchtable[$k];>&nbsp;</td>";	
			}else{
				// colspan agrega una coluna de tantos iconos tengamos
				$result.= '<td colspan="'.count($iconos).'">

				<form method="post">
				
				<input type="hidden" name="accion" value="formNew" />
				<input type="image" src="../imagenes/add.png"></form>

				</td>';	
			}

			$k++;
		//}
	}
	//echo $columnas;
	//echo $k;
	//$k=$k-1;
	for ($c=0; $c < $columnas; $c++){
		// para traer los nombres de los campos
		$campo=mysqli_fetch_field_direct($registros,$c); // da la informacion de un campo en la base de datos
		 
		 if (count($anchtable)) {
				$result.= "<td style=width:$anchtable[$k];>$campo->name.$c</td>";	
			}else{
				$result.= '<td style="width:(90/$columnas)%">'.$campo->name.'</td>';		
			}
		 // echo $anchtable[$c];
		 $k++;
		
	}
	$result.= '</tr>';
	// fin cabecera
	// comienzo de registros
	for ($r=0; $r < $this->numeRegistros; $r++) 
	{ $result.= '<tr>';
		$campos = mysqli_fetch_array($registros); // regresa un arreglo doble
		// agregando iconos
		// EN EL CASO DE QUE "UPDATE EXISTA EN EL ARRGLO DE LOS ICONOS"
		if (in_array("update", $iconos)) {
			//da comportamiento de los iconos
			//$result.= '<td style="width:5%"><img src="../imagenes/update.png"></td>';
			$result.= '<td style="width:5%"><form method="post" action="">
			<input type="hidden" name="Id" value="'.$campos['Id'].'" />
			<input type="hidden" name="accion" value="formUpdate" />
			<input type="image" src="../imagenes/update.png"></form></td>';
		}

		if (in_array("delete", $iconos)) {
			//da comportamiento de los iconos
			$result.= '<td style="width:5%"><form method="post" action="">
			<input type="hidden" name="Id" value="'.$campos['Id'].'" />
			<input type="hidden" name="accion" value="delete" />
			<input type="image" src="../imagenes/delete.png"
			onclick="return confirm(\'Estas seguro\')">
			</form></td>';

		}

		// Opciones de icono (addPregunta)

		if (in_array("addPreg", $iconos)) {
			//da comportamiento de los iconos
			$result.= '<td style="width:5%"><form method="post" action="pregunta.php">
			<input type="hidden" name="Id" value="'.$campos['Id'].'" />
			<input type="hidden" name="accion" value="list" />
			<input type="image" src="../imagenes/addPreg.png"></form></td>';
		}

		// Opciones de icono (view)

		if (in_array("vista", $iconos)) {
			//da comportamiento de los iconos
			$result.= '<td style="width:5%"><form method="post" action="preview.php">
			<input type="hidden" name="Id" value="'.$campos['Id'].'" />
			<input type="hidden" name="accion" value="preview" />
			<input type="image" src="../imagenes/view.png"></form></td>';
		}

		if (in_array("pru", $iconos)) {
			//da comportamiento de los iconos
			$result.= '<td style="width:5%"><form method="post" action="preview.php">
			<input type="hidden" name="Id" value="'.$campos['Id'].'" />
			<input type="hidden" name="accion" value="preview" />

			<input type="image" src="../imagenes/view.png"></form></td>';

		switch ($campos['Tipo']) {

				case 'Abierta':

					# Abierta

					echo '<br><br>';
					echo $campos['Id'];
					echo '<h5>'.$campos['Pregunta'].'</h5>';
					// echo $campos['Tipo'];

					echo '<input type="text" size="150" maxlength="30" value="" name="nombre">';

					break;

				case 'Opcion Multiple':

					# Opcion Multiple

					echo '<br><br>';
					echo $campos['Id'];
					echo '<h5>'.$campos['Pregunta'].'</h5>';

					echo '<label><input type="checkbox" id="cbox1" value="first_checkbox">Opcion 1</label><br>';
					echo '<label><input type="checkbox" id="cbox1" value="first_checkbox">Opcion 2</label><br>';
					echo '<label><input type="checkbox" id="cbox1" value="first_checkbox">Opcion 3</label><br>';
					echo '<label><input type="checkbox" id="cbox1" value="first_checkbox">Opcion 4</label><br>';
					

					break;
				
				case 'SI/NO':

					# SI/NO

					echo '<br><br>';
					echo $campos['Id'];
					echo '<h5>'.$campos['Pregunta'].'</h5>';

					echo '<input type="radio" id="Y" name="gender" value="male">
						<label for="Y">Si</label>
						<input type="radio" id="N" name="gender" value="female">
						<label for="N">No</label><br>';
					break;

				default:
					# code...
					break;
			}

		}

		// $campos['Id'] --dame el valor del campo que se llama Id regresa numero
		
		// despliega la informacion de un registro especifico
		// dame los campos deacuerdo  a la posicion que te tragiste de la conulta
		for ($c=0; $c < $columnas; $c++) 
			$result.= '<td>'.$campos[$c].'</td>';
	  $result.= '</tr>';
		
	}
$result.= '</table></div>';
// retorna la tabla
return $result;
//echo $k;
} 
// fin de la funcion desplegar tabla dinamica		

public function creaSelect($tabla,$PK,$campDesplegar,$nameSelect,$IdSeleccionado=0){

	$cad = "SELECT ".$PK." as PK,".$campDesplegar." as dato from ".$tabla." order by ".$campDesplegar;
	$registros = $this->consulta($cad);
	$result = '<select class="form-control" name="'.$nameSelect.'">';

	$result.='<option value="0">Selecciona</option>';
	foreach ($registros as $registro) {
		$result.='<option value="'.$registro['PK'].'"'.(($IdSeleccionado==$registro['PK'])?"selected":"").'>'.$registro['dato'].'</option>';
	}

	$result.='</select>';
	return $result;
}


}

// creacion de objeto en la base de datos
	$oBD=new BaseDatos();

?>
