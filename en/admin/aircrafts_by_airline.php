<?php
if(isset($_GET["airline"]))
{
	$airline = $_GET["airline"];
	include "../user/files/conexion.php";
	if(isset($_GET["aircraft"])){
		$aircraft = $_GET["aircraft"];
		$stmt = $mysqli->prepare("SELECT id, name FROM aircraft WHERE airline = ? ORDER BY id");
		$stmt->bind_param('i',$_GET['airline']);
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($id,$name);
		echo "<option value=''>Chosse the aircraft</option>";
		while($stmt->fetch())
		{
			if($id == $aircraft)
			{ 
				echo "<option value='$id' selected='selected'>$name</option>";
			}else{
				echo "<option value='$id'>$name</option>";
			}
		}
	}else{
		
		$stmt = $mysqli->prepare("SELECT id, name FROM aircraft WHERE airline = ? ORDER BY id");
		$stmt->bind_param('i',$_GET['airline']);
		$stmt->execute(); 
		$stmt->store_result();
		$stmt->bind_result($id,$name);
		echo "<option value=''>Chosse the aircraft</option>";
		while($stmt->fetch())
		{
			echo "<option value='$id'>$name</option>";
		}
	}			
	
}
?>