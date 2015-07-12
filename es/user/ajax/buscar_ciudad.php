<?php 
	include "../files/conexion.php";

 	$stmt = $mysqli->prepare("SELECT `id`, `city`, `state` FROM `cities` ORDER BY `id`");
	$stmt->execute(); 
	$result = $stmt->get_result();
 		$arrayJson = array();
		array_push($arrayJson, '<option value="" disabled selected>Seleccione una ciudad</option>');
			while($fila = mysqli_fetch_assoc($result))
			{

				array_push($arrayJson,'<option value='.$fila['id'].'>'.$fila['city'].' - '.$fila['state'].'</option>');

			}
	$json = str_replace('\\/', '/', json_encode($arrayJson));
	echo $json;

?>