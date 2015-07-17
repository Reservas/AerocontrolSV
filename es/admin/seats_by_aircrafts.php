<?php
if(isset($_GET["seats"]))
{
	$airline = $_GET["seats"];
	include "../user/files/conexion.php";
		$stmt = $mysqli->prepare("SELECT id, seats
FROM aircraft
WHERE id = ?
ORDER BY id");
		$stmt->bind_param('i',$_GET['seats']);
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($id,$seats);
    $stmt->fetch();
		echo $seats;
	}			
?>