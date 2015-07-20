<?php 
	include "../files/conexion.php";

	if(isset($_GET['airline'])){
		if(isset($_GET['destiny'])){
			$destiny = $_GET['destiny'];
		}else{
			$destiny = 'false';
		}
		if($destiny == 'true'){
			$stmt = $mysqli->prepare("SELECT DISTINCT `cities`.`id`, `cities`.`city`, `cities`.`state` FROM `cities` INNER JOIN `flights` ON `cities`.`id` = `flights`. `departure_city` WHERE `flights`.`airline` = ? ORDER BY `id`");
		}else{
			$stmt = $mysqli->prepare("SELECT DISTINCT `cities`.`id`, `cities`.`city`, `cities`.`state` FROM `cities` INNER JOIN `flights` ON `cities`.`id` = `flights`. `arrival_city` WHERE `flights`.`airline` = ? ORDER BY `id`");
		}
		$stmt->bind_param('i',$_GET['airline']);
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
	}else{
	
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
	}

?>