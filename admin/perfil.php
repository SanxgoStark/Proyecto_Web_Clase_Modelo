<? 

// NOTA : EL ORDEN ENQUE SE COLOQUEN LOS INCLUDE PUEDE AFECTAR EN EL FUNCIONAMIENTO 
//inclusion de hoja general de estilos
include "header.php";
// incluye lo de la base de datos
include "../class/classBaseDatos.php";
# PROCESAR EL UPDATE (EL ORDEN DONDE SE COLOQUE ES MUY IMPORTANTE)

//SI ME ESTAN ENVIANDO EL NOMBRE ,SIGNIFICA QUE ME ESTAN ENVIANDO LOS DATPS
//actualizacion de datos generales
if (isset($_POST['Nombre'])){
	$oBD->consulta("UPDATE usuario set Nombre = '".$_POST['Nombre']."',Apellidos='".$_POST['Apellidos']."',Password=password('".$_POST['Password']."') where id=".$_SESSION['Id']);

	// se cambia la sesion para reflejar cambios al actualizar
	$_SESSION['nombre']=$_POST['Nombre'].' '.$_POST['Apellidos'];

	//para validar el envio de un archivo (name---name tiene que ver con le archivo fisico)
	//name variable que almacena el titulo que tiene el archivo fisico
	if($_FILES['foto']['name']>"") // para validar el envio del archivo
	{
		//echo "Se envio el archivo";

		// name contiene el nombre original del recurso que estoy cargando
		$arreExtension=explode(".",$_FILES['foto']['name']);
		$posicion=count($arreExtension)-1;
		$extension=$arreExtension[$posicion]; // la extencion del archivo de imagen se guarda aqui
		// voy a mover un archivo que fue cargado
		// esta funcion ya sabe que el archivo fue cargado en el archivo de temporales
		// mueve el archivo de los temporale a un destino final
		move_uploaded_file($_FILES['foto']['tmp_name'], "../fotos/".$_SESSION['Id'].".".$extension);// con esto mis archivos ya contendrn el id de mi usuario
		                                                            //cambia el nombre del archi //con el nombre que se te //envio
		$oBD->consulta("UPDATE usuario set Foto = '".$extension."' where Id=".$_SESSION['Id']);

		// la sesion foto cambia al actualizar una imagen
		$_SESSION['foto']=$_SESSION['Id'].".".$extension."?".rand()%100; // con rand hace que se muestren los cambios que el usuario realizo 
	}
}
include "menu.php"; 





// CONSULTA PARA COONSULTAR DATOS DE USUARIO POR ID O EMAIL
$usuario=$oBD->saca_tupla("SELECT * from usuario where Id = ".$_SESSION['Id']); 

?>

<!-- contenedor principal -->
<div class="container" style="background: rgb(14,89,125);">

	<div class="row" style="">
		<div class="col-md-6">
			<form method="post" enctype="multipart/form-data" role="form">
				<div class="form-group">
					 
					<label>
						Nombre
					</label>
					<input type="text" class="form-control" name="Nombre" value="<?echo $usuario->Nombre;?>" />
				</div>
				<div class="form-group">
					 
					<label>
						Apellidos
					</label>
					<input type="text" class="form-control" name="Apellidos" value="<?echo $usuario->Apellidos;?>" />
				</div>
				<div class="form-group">
					 
					<label>
						Password
					</label>
					<input type="password" class="form-control" name="Password" />

				</div>
				<div class="form-group">
					 
					<label>
						Foto
					</label>
					<input type="file" class="form-control-file" name="foto" accept="image/jpeg" />

				</div>
				
				<button type="submit" class="btn btn-primary">
					Actualizar
				</button>
			</form>
		</div>
	</div>
	

</div> 

	
</body>
</html>

