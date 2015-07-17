<?php 
	include "../files/conexion.php";

 	$stmt = $mysqli->prepare("SELECT `id`, `name` FROM `airlines` ORDER BY `id`");
	$stmt->execute(); 
	$result = $stmt->get_result();
 		$arrayJson = array();
		array_push($arrayJson, '<option value="" disabled selected>Seleccione una aerolinea</option>');
			while($fila = mysqli_fetch_assoc($result))
			{

				array_push($arrayJson,'<option value='.$fila['id'].'>'.$fila['name'].'</option>');

			}
	$json = str_replace('\\/', '/', json_encode($arrayJson));
	echo $json;

?>