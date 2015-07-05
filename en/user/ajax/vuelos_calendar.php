<?php
include "../files/conexion.php";
	
	$stmt = $mysqli->prepare("SELECT f.description, f.departure_time, f.arrival_time FROM flights f ORDER BY f.id");
	$stmt->execute(); 
	$result = $stmt->get_result();
	$json = '[';
	$counter = 0;
	while($row = mysqli_fetch_assoc($result))
	{ 
		if($counter == 0){
			$json = $json.'{"title": "'.$row['description'].'", "start": "'.$row['departure_time'].'", "end": "'.$row['arrival_time'].'"}';
		}else{
			$json = $json.',{"title": "'.$row['description'].'", "start": "'.$row['departure_time'].'", "end": "'.$row['arrival_time'].'"}';
		}
		$counter = $counter + 1;
	}
	$json = $json.']';
	echo $json;
?>