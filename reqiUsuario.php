<?php
//include "classBD.php";
$conexion=mysqli_connect("localhost", "encuestador", '1234','encuestas');

$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
$numeC=strlen($cadena);
$nuevPWD="";
for ($i=0; $i<8; $i++)
  $nuevPWD.=$cadena[rand()%$numeC]; 

$cad="INSERT INTO usuario SET Nombre='".$_POST['nombre']."', Apellidos='".$_POST['apellidos']."', Email='".$_POST['email']."', Password=password('".$nuevPWD."')";


 include "servicios/class.phpmailer.php";
 include("servicios/class.smtp.php");

$mail = new PHPMailer();
$mail->IsSMTP();
    $mail->Host="smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
                              // 1 = errors and messages
                              // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication
    
    $mail->Username =   "ulisesbtxm@gmail.com"; // SMTP account username
    $mail->Password = "mumeroJA-129";  // SMTP account password
      
    $mail->From="";
    $mail->FromName="";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO ".$_POST['nombre']." ".$_POST['apellidos']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
    $mail->AddAddress($_POST['email']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send()) 
          echo  "Error: " . $mail->ErrorInfo;
    else { 

    	// verificar que no haya repeticiones de email
    	$bloque = mysqli_query($conexion,"SELECT * FROM usuario WHERE Email='".$_POST['email']."';");

    	if($bloque){
    		$cad="INSERT INTO usuario SET Nombre='".$_POST['nombre']."', Apellidos='".$_POST['apellidos']."', Email='".$_POST['email']."', Password=password('".$nuevPWD."')";
    		mysqli_query($conexion,$cad);
    		header("location: registro.php?m=1");
    	}else{
    		header("location: registro.php?m=2");
    	}
    	

            }
/*

PROBLEMAS A SOLUCIONAR EN EL REGISTRO
1) DETECTAR QUE EL CORREO YA ESTA REGISTRADO, 
   YA QUE ES LA LLAVE PRIMARIA Y NO SE DEBE ENVIAR
   EL CORREO SI YA ESTABA REGISTRADO.
2) LA CLAVE DEBE DE CIFRARSE, POR QUE EN EL 
   LOGUEO SE CIFRA.


*/


?>
