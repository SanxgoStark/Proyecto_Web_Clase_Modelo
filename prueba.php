
<!-- <?php

	echo "input";
    echo "hola mundo";

    $hola = 45.78;

    echo '<span class= "btn btn-secondary"> hola mundo </span>';
    print "<hr>";
?>

<h4>esto esta fuera de un script</h4>

<?php
    echo "<h2> esto es un h2 </h2>";
?>

<?
    echo "<h2> esto es un h2 </h2>";
?>

 
<?php
    echo "<h2> esto es un h2 </h2>";
?> -->

<form method="">
Dato A <input type="text"
name = "datoA"> <br>
<br/>
Dato B <input type="text"
name = "datoB"> <br>
<br/>
<select name="operacion">
	<option value="1">Sumar</option>
	<option value="2">Restar</option>
	<option value="3">Multiplicar</option>
	<option value="4">Dividir</option>
	<option value="5">Raiz</option>
	<option value="6">Potencia</option>
</select>
<button type="submit">Enviar</button>
<!-- perimite mostrar un boton para enviar los dats cuando se haga clic sobre el -->
<input type="submit"> 

</form>

<?php 
	$num1 = $_GET['datoA'];
	$num2 = $_GET['datoB'];
	$operacion = $_GET['operacion'];

	if (isset($_GET['operacion'])) {

		if ($operacion == "1") {
			$sum = $num1 + $num2;
			echo "$num1 + $num2<br>";
			echo "suma: " . $sum;}
		else if ($operacion == "2") {
			$rest = $num1 - $num2;
			echo "$num1 - $num2<br>";
			echo "resta: " . $rest;}
		else if ($operacion == "3") {
			$mult = $num1 * $num2;
			echo "$num1 * $num2<br>";
			echo "multiplicacion: " . $mult;}
		else if ($operacion == "4") {

			if ($num2 != 0) {
				$divi = $num1 / $num2;
				echo "$num1 / $num2<br>";
				echo "divicion: " . $divi;
			}else{
				echo "Por favor verifique su entrada, no es posible realizar diviciones entre 0";
			}}
		else if ($operacion == "5") {

			if ($num1 >= 0) {
				$raiz = sqrt($num1);
				echo "$raiz($num1)";
				echo "raiz: " . $raiz;
			}else{
				echo "Por favor verifique su entrada, no es posible obtener la raiz de un numero negativo";
			}

		}
		else if ($operacion == "6") {
			echo "$num1 exp($num2)<br>";
			echo pow($num1,$num2);

		}	
	}
	
 ?>



