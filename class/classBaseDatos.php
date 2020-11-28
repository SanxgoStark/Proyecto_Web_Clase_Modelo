<?php
// Guarda objetos programables hacia la base de datos (comportamiento natural de una bd)
class BaseDatos{

	// cuando construya un objeto me gere la conexion
	var $conexion; // atributo

	// se almacenan el numero de registros
	var $numeRegistros;

	function conecta(){
		// no aplicar signo de pesos a conexion al inicio con el $ del this esta bien 
			$this->conexion=mysqli_connect("localhost", "encuestador", '1234','encuestas');
		}

	function cierraBD(){
			mysqli_close($this->conexion);
		}

	function consulta($query){
			$this->conecta(); // se abre conexion
			// guardo consulta en bloque
			$bloque=mysqli_query($this->conexion,$query); // se realiza consulta

			// if si el cueri es un select
			if (strpos(strtoupper($query) , "SELECT")!==false)
			  // se almacena el numero de registros que contiene el bloque
			  $this->numeRegistros=mysqli_num_rows($bloque);
			else $this->numeRegistros=0;

			$this->cierraBD();
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

}

// creacion de objeto en la base de datos
	$oBD=new BaseDatos();

?>
